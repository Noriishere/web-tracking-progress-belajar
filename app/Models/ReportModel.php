<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class ReportModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProgressHarianUser($userId)
    {
        $this->db->query("
            SELECT *
            FROM v_progress_harian_user
            WHERE id_user = :uid
            ORDER BY study_date DESC
        ");
        $this->db->bindValue(':uid', $userId);
        return $this->db->resultSet();
    }

    public function getProgressPerMataKuliah($userId)
    {
        $this->db->query("
            SELECT *
            FROM v_progress_per_mata_kuliah
            WHERE id_user = :uid
            ORDER BY total_minutes DESC
        ");
        $this->db->bindValue(':uid', $userId);
        return $this->db->resultSet();
    }

    public function getRekapBelajarYoutube($userId)
    {
        $this->db->query("
            SELECT *
            FROM v_rekap_belajar_youtube
            WHERE id_user = :uid
            ORDER BY last_watched DESC
        ");
        $this->db->bindValue(':uid', $userId);
        return $this->db->resultSet();
    }
}
