<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class StudyActivityModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM study_activities ORDER BY activity_name ASC");
        return $this->db->resultSet();
    }

    public function getByName($name)
    {
        $this->db->query("SELECT * FROM study_activities WHERE activity_name = :name LIMIT 1");
        $this->db->bindValue(':name', $name);
        return $this->db->single();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM study_activities WHERE id_activity = :id LIMIT 1");
        $this->db->bindValue(':id', $id);
        return $this->db->single();
    }
}
