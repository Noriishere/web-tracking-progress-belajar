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

    public function addSession($userId, $subjectId, $activityId, $startTime, $endTime, $durationMinutes, $productivity)
    {
        $this->db->query("
    INSERT INTO study_sessions
    (user_id, subject_id, activity_id, start_time, end_time, duration_minutes, productivity_level, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
");
        $this->db->bindValue(1, $userId);
        $this->db->bindValue(2, $subjectId);
        $this->db->bindValue(3, $activityId);
        $this->db->bindValue(4, $startTime);
        $this->db->bindValue(5, $endTime);
        $this->db->bindValue(6, (int)$durationMinutes);
        $this->db->bindValue(7, $productivity);
        $this->db->execute();
    }

    public function addSessionFromArray(array $data)
    {
        $this->db->query("
            INSERT INTO study_sessions
            (user_id, subject_id, activity_id, start_time, end_time, duration_minutes, productivity_level, created_at)
            VALUES (:uid, :sid, :aid, :st, :et, :dur, :prod, NOW())
        ");
        $this->db->bindValue(':uid', $data['user_id']);
        $this->db->bindValue(':sid', $data['subject_id']);
        $this->db->bindValue(':aid', $data['activity_id']);
        $this->db->bindValue(':st', $data['start_time']);
        $this->db->bindValue(':et', $data['end_time']);
        $this->db->bindValue(':dur', $data['duration_minutes']);
        $this->db->bindValue(':prod', $data['productivity_level']);
        $this->db->execute();
    }

    public function hasSessionToday($userId)
    {
        $this->db->query("
            SELECT COUNT(*) AS total
            FROM study_sessions
            WHERE user_id = ?
            AND DATE(end_time) = CURDATE()
            AND duration_minutes > 0
        ");
        $this->db->bindValue(1, $userId);
        $row = $this->db->single();
        return (int) $row['total'] > 0;
    }

    public function chartLast7Days($userId)
    {
        // ambil tanggal hari ini dari DB
        $this->db->query("SELECT CURDATE() AS today");
        $today = $this->db->single()['today'];

        $this->db->query("
        SELECT DATE(end_time) AS tanggal, SUM(duration_minutes) AS total
        FROM study_sessions
        WHERE user_id = ?
        AND end_time >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY DATE(end_time)
    ");
        $this->db->bindValue(1, $userId);
        $rows = $this->db->resultSet();

        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime("$today -$i days"));
            $labels[] = date('D', strtotime($day));

            $found = 0;
            foreach ($rows as $r) {
                if ($r['tanggal'] === $day) {
                    $found = (int)$r['total'];
                    break;
                }
            }
            $data[] = $found;
        }

        return ['labels' => $labels, 'data' => $data];
    }


    public function recentSessions($userId, $limit = 6)
    {
        $limit = (int) $limit;

        $this->db->query("
        SELECT s.*, a.activity_name, sub.subject_name
        FROM study_sessions s
        LEFT JOIN study_activities a ON s.activity_id = a.id_activity
        LEFT JOIN subjects sub ON s.subject_id = sub.id_subject
        WHERE s.user_id = ?
        ORDER BY s.end_time DESC
        LIMIT $limit
    ");
        $this->db->bindValue(1, $userId);
        return $this->db->resultSet();
    }


    public function totalSessions($userId)
    {
        $this->db->query("
            SELECT COUNT(*) AS total
            FROM study_sessions
            WHERE user_id = ?
        ");
        $this->db->bindValue(1, $userId);
        $row = $this->db->single();
        return (int) $row['total'];
    }

    public function totalMinutesThisWeek($userId)
    {
        $this->db->query("
            SELECT COALESCE(SUM(duration_minutes),0) AS total
            FROM study_sessions
            WHERE user_id = :uid
            AND YEARWEEK(end_time, 1) = YEARWEEK(NOW(), 1)
        ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return (int) $row['total'];
    }

    public function totalMinutesLastWeek($userId)
    {
        $this->db->query("
            SELECT COALESCE(SUM(duration_minutes),0) AS total
            FROM study_sessions
            WHERE user_id = :uid
            AND YEARWEEK(end_time, 1) = YEARWEEK(NOW(), 1) - 1
        ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return (int) $row['total'];
    }

    public function mostProductiveDay($userId)
    {
        $this->db->query("
            SELECT DAYNAME(end_time) AS day_name, SUM(duration_minutes) AS total
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

    public function bestHour($userId)
    {
        $this->db->query("
            SELECT HOUR(end_time) AS hour_slot, SUM(duration_minutes) AS total
            FROM study_sessions
            WHERE user_id = :uid
            GROUP BY hour_slot
            ORDER BY total DESC
            LIMIT 1
        ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return $row ? (int) $row['hour_slot'] : null;
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
}
