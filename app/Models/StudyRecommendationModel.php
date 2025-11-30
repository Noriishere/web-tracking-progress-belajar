<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class StudyRecommendationModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getByUser($userId)
    {
        $this->db->query("SELECT * FROM study_recommendation WHERE user_id = :uid LIMIT 1");
        $this->db->bindValue(':uid', $userId);
        return $this->db->single();
    }

    public function saveRecommendation($userId, $bestHour, $productiveDay)
    {
        $exists = $this->getByUser($userId);

        if ($exists) {
            $this->db->query("
                UPDATE study_recommendation
                SET best_hour = :bh, most_productive_day = :pd
                WHERE user_id = :uid
            ");
        } else {
            $this->db->query("
                INSERT INTO study_recommendation (user_id, best_hour, most_productive_day)
                VALUES (:uid, :bh, :pd)
            ");
        }

        $this->db->bindValue(':uid', $userId);
        $this->db->bindValue(':bh', $bestHour);
        $this->db->bindValue(':pd', $productiveDay);
        $this->db->execute();
    }
}
