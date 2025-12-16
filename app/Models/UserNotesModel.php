<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserNotesModel extends Database
{
    /* =====================
       UTIL
    ===================== */

    private function countWords($text)
    {
        $clean = trim(preg_replace('/\s+/u', ' ', strip_tags($text)));
        if ($clean === '') return 0;
        return count(preg_split('/\s+/u', $clean));
    }

    /* =====================
       STATS
    ===================== */

    public function countToday($userId)
    {
        $this->query("
            SELECT COUNT(*) AS total
            FROM user_notes
            WHERE user_id = ?
            AND activity_date = CURDATE()
        ");
        $this->bindValue(1, $userId);
        return (int) $this->single()['total'];
    }

    public function wordToday($userId)
    {
        $this->query("
            SELECT SUM(word_count) AS total
            FROM user_notes
            WHERE user_id = ?
            AND activity_date = CURDATE()
        ");
        $this->bindValue(1, $userId);
        $row = $this->single();
        return (int) ($row['total'] ?? 0);
    }

    /* =====================
       READ
    ===================== */

    public function recentNotes($userId)
    {
        $this->query("
            SELECT id_note, activity_date, content, word_count
            FROM user_notes
            WHERE user_id = ?
            ORDER BY id_note DESC
            LIMIT 5
        ");
        $this->bindValue(1, $userId);
        return $this->resultSet();
    }

    public function getAllNotes($userId)
    {
        $this->query("
            SELECT *
            FROM user_notes
            WHERE user_id = ?
            ORDER BY id_note DESC
        ");
        $this->bindValue(1, $userId);
        return $this->resultSet();
    }

    public function getNoteById($id)
    {
        $this->query("SELECT * FROM user_notes WHERE id_note = ?");
        $this->bindValue(1, $id);
        return $this->single();
    }

    /* =====================
       CREATE (DIPAKAI CONTROLLER)
    ===================== */

    public function addNote($userId, $content, $subjectId = null)
    {
        $this->query("
        INSERT INTO user_notes (user_id, subject_id, activity_date, content)
        VALUES (?, ?, CURDATE(), ?)
    ");
        $this->bindValue(1, $userId);
        $this->bindValue(2, $subjectId);
        $this->bindValue(3, $content);
        $this->execute();

        return $this->lastInsertId();
    }


    /* =====================
       UPDATE
    ===================== */

    public function updateNoteContent($noteId, $content)
    {
        $wordCount = $this->countWords($content);

        $this->query("
            UPDATE user_notes
            SET content = ?, word_count = ?
            WHERE id_note = ?
        ");
        $this->bindValue(1, $content);
        $this->bindValue(2, $wordCount);
        $this->bindValue(3, $noteId);
        $this->execute();
    }

    /* =====================
       DELETE
    ===================== */

    public function deleteNote($id)
    {
        $this->query("DELETE FROM user_notes WHERE id_note = ?");
        $this->bindValue(1, $id);
        $this->execute();
    }
}
