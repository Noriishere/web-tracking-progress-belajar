<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserNotesModel extends Database
{
    public function countToday($userId)
    {
        $this->query("SELECT COUNT(*) AS total FROM user_notes WHERE user_id = ? AND activity_date = CURDATE()");
        $this->bindValue(1, $userId);
        $data = $this->single();
        return $data['total'];
    }

    public function wordToday($userId)
    {
        $this->query("SELECT SUM(word_count) AS total FROM user_notes WHERE user_id = ? AND activity_date = CURDATE()");
        $this->bindValue(1, $userId);
        $data = $this->single();
        return $data['total'] ?? 0;
    }

    public function recentNotes($userId)
    {
        $this->query("SELECT id_note, activity_date, content, word_count 
                      FROM user_notes 
                      WHERE user_id = ?
                      ORDER BY id_note DESC
                      LIMIT 5");
        $this->bindValue(1, $userId);
        return $this->resultSet();
    }

    public function addNote($userId, $content, $wordCount)
    {
        $this->query("
            INSERT INTO user_notes (user_id, activity_date, content, word_count)
            VALUES (?, CURDATE(), ?, ?)
        ");
        $this->bindValue(1, $userId);
        $this->bindValue(2, $content);
        $this->bindValue(3, $wordCount);
        $this->execute();
        $this->query("SELECT LAST_INSERT_ID() AS id");
        $res = $this->single();
        return $res['id'];
    }

    public function updateNoteContent($noteId, $content)
    {
        $wordCount = str_word_count($content);
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

    public function getAllNotes($userId)
    {
        $this->query("SELECT * FROM user_notes WHERE user_id = ? ORDER BY id_note DESC");
        $this->bindValue(1, $userId);
        return $this->resultSet();
    }

    public function getNoteById($id)
    {
        $this->query("SELECT * FROM user_notes WHERE id_note = ?");
        $this->bindValue(1, $id);
        return $this->single();
    }

    public function deleteNote($id)
    {
        $this->query("DELETE FROM user_notes WHERE id_note = ?");
        $this->bindValue(1, $id);
        $this->execute();
    }
}
