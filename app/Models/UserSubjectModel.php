<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserSubjectModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSubjectsByUser($userId)
    {
        $this->db->query("
        SELECT us.*, s.subject_name, s.youtube_playlist_id
        FROM user_subjects us
        JOIN subjects s ON us.subject_id = s.id_subject
        WHERE us.user_id = :id
    ");
        $this->db->bindValue(':id', $userId);
        return $this->db->resultSet();
    }

    public function getSubjectIdsByUser($userId)
    {
        $this->db->query("SELECT subject_id FROM user_subjects WHERE user_id = :id");
        $this->db->bindValue(':id', $userId);
        $results = $this->db->resultSet();
        return array_map(function ($row) {
            return $row['subject_id'];
        }, $results);
    }

    public function setSubjectsForUser($userId, $subjectIds)
    {
        $this->db->query("DELETE FROM user_subjects WHERE user_id=:id");
        $this->db->bindValue(':id', $userId);
        $this->db->execute();

        foreach ($subjectIds as $sid) {
            $this->db->query("INSERT INTO user_subjects (user_id, subject_id) VALUES (:uid, :sid)");
            $this->db->bindValue(':uid', $userId);
            $this->db->bindValue(':sid', $sid);
            $this->db->execute();
        }
    }
}
