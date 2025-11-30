<?php
namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class SubjectModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllSubjects()
    {
        $this->db->query("SELECT * FROM subjects ORDER BY subject_name ASC");
        return $this->db->resultSet();
    }

    public function addSubject($name)
    {
        $this->db->query("INSERT INTO subjects (subject_name) VALUES (:name)");
        $this->db->bindValue(':name', $name);
        return $this->db->execute();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM subjects WHERE id_subject=:id");
        $this->db->bindValue(':id', $id);
        return $this->db->single();
    }

    public function updateSubject($id, $name)
    {
        $this->db->query("UPDATE subjects SET subject_name=:name WHERE id_subject=:id");
        $this->db->bindValue(':name', $name);
        $this->db->bindValue(':id', $id);
        return $this->db->execute();
    }

    public function deleteSubject($id)
    {
        $this->db->query("DELETE FROM subjects WHERE id_subject=:id");
        $this->db->bindValue(':id', $id);
        return $this->db->execute();
    }
}
