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


    public function getAll()
    {
        $this->db->query("SELECT * FROM subjects ORDER BY subject_name ASC");
        return $this->db->resultSet();
    }


    public function getById($id)
    {
        $this->db->query("SELECT * FROM subjects WHERE id_subject = :id");
        $this->db->bindValue(':id', $id);
        return $this->db->single();
    }


    public function add($name, $playlistId = null)
    {
        $this->db->query("INSERT INTO subjects (subject_name, youtube_playlist_id, created_at) VALUES (:name, :pid, NOW())");
        $this->db->bindValue(':name', $name);
        $this->db->bindValue(':pid', $playlistId);
        $this->db->execute();
        $this->db->query("SELECT LAST_INSERT_ID() AS id");
        $res = $this->db->single();
        return $res['id'];
    }


    public function update($id, $name, $playlistId = null)
    {
        $this->db->query("UPDATE subjects SET subject_name = :name, youtube_playlist_id = :pid WHERE id_subject = :id");
        $this->db->bindValue(':name', $name);
        $this->db->bindValue(':pid', $playlistId);
        $this->db->bindValue(':id', $id);
        return $this->db->execute();
    }


    public function delete($id)
    {
        $this->db->query("DELETE FROM subjects WHERE id_subject = :id");
        $this->db->bindValue(':id', $id);
        return $this->db->execute();
    }
}
