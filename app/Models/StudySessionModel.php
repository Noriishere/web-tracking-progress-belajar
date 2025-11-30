<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class StudySessionModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addSession($userId, $subjectId, $activityId, $startTime, $endTime, $durationMinutes, $productivity, $noteId = null)
    {
        $this->db->query("INSERT INTO study_sessions (user_id, subject_id, activity_id, start_time, end_time, duration_minutes, productivity_level, created_at) VALUES (:uid, :sid, :aid, :st, :et, :dur, :prod, NOW())");
        $this->db->bindValue(':uid', $userId);
        $this->db->bindValue(':sid', $subjectId);
        $this->db->bindValue(':aid', $activityId);
        $this->db->bindValue(':st', $startTime);
        $this->db->bindValue(':et', $endTime);
        $this->db->bindValue(':dur', $durationMinutes);
        $this->db->bindValue(':prod', $productivity);
        $this->db->execute();
    }

    public function chartLast7Days($userId)
    {
        $this->db->query("
        SELECT 
            DATE(start_time) AS tanggal,
            SUM(duration_minutes) AS total
        FROM study_sessions
        WHERE user_id = :id
        AND start_time >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY DATE(start_time)
        ORDER BY tanggal ASC
    ");

        $this->db->bindValue(':id', $userId);
        $rows = $this->db->resultSet();

        $labels = [];
        $data   = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = date("Y-m-d", strtotime("-$i days"));
            $labels[] = date("D", strtotime($day));

            $found = array_filter($rows, fn($x) => $x['tanggal'] === $day);
            $data[] = $found ? array_values($found)[0]['total'] : 0;
        }

        return ['labels' => $labels, 'data' => $data];
    }


    public function activityBreakdownLast7Days($userId)
    {
        $this->db->query("
            SELECT a.activity_name, COALESCE(SUM(s.duration_minutes),0) AS total
            FROM study_sessions s
            LEFT JOIN study_activities a ON s.activity_id = a.id_activity
            WHERE s.user_id = :uid AND s.start_time >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY a.activity_name
            ORDER BY total DESC
        ");
        $this->db->bindValue(':uid', $userId);
        return $this->db->resultSet();
    }

    public function recentSessions($userId, $limit = 6)
    {
        $this->db->query("SELECT s.*, a.activity_name, sub.subject_name FROM study_sessions s LEFT JOIN study_activities a ON s.activity_id = a.id_activity LEFT JOIN subjects sub ON s.subject_id = sub.id_subject WHERE s.user_id = :uid ORDER BY s.start_time DESC LIMIT :lim");
        $this->db->bindValue(':uid', $userId);
        $this->db->bindValue(':lim', $limit);
        return $this->db->resultSet();
    }
    public function mostProductiveDay($userId)
    {
        $this->db->query("
        SELECT DAYNAME(start_time) AS day_name, SUM(duration_minutes) AS total
        FROM study_sessions
        WHERE user_id = :uid
        GROUP BY day_name
        ORDER BY total DESC
        LIMIT 1
    ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return $row ? $row['day_name'] : null;
    }

    public function totalMinutesThisWeek($userId)
    {
        $this->db->query("
        SELECT SUM(duration_minutes) AS total
        FROM study_sessions
        WHERE user_id = :uid
        AND YEARWEEK(start_time, 1) = YEARWEEK(NOW(), 1)
    ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return $row ? intval($row['total']) : 0;
    }

    public function totalMinutesLastWeek($userId)
    {
        $this->db->query("
        SELECT SUM(duration_minutes) AS total
        FROM study_sessions
        WHERE user_id = :uid
        AND YEARWEEK(start_time, 1) = YEARWEEK(NOW(), 1) - 1
    ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return $row ? intval($row['total']) : 0;
    }

    public function topSubject($userId)
    {
        $this->db->query("
        SELECT sub.subject_name, SUM(s.duration_minutes) AS total
        FROM study_sessions s
        LEFT JOIN subjects sub ON sub.id_subject = s.subject_id
        WHERE s.user_id = :uid
        GROUP BY s.subject_id
        ORDER BY total DESC
        LIMIT 1
    ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return $row ? $row['subject_name'] : null;
    }
    public function bestHour($userId)
{
    $this->db->query("
        SELECT HOUR(start_time) AS hour_slot, SUM(duration_minutes) AS total
        FROM study_sessions
        WHERE user_id = :uid
        GROUP BY hour_slot
        ORDER BY total DESC
        LIMIT 1
    ");
    $this->db->bindValue(':uid', $userId);
    $row = $this->db->single();
    return $row ? intval($row['hour_slot']) : null;
}

}
