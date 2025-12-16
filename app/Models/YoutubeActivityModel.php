<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class YoutubeActivityModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addActivity($userId, $subjectId, $url, $title, $duration, $noteId)
    {
        // insert youtube_activity
        $this->db->query("
        INSERT INTO youtube_activity 
        (user_id, subject_id, video_url, video_title, duration_minutes, note_id, created_at)
        VALUES (:u, :s, :url, :title, :d, :n, NOW())
    ");

        $this->db->bindValue(":u", $userId);
        $this->db->bindValue(":s", $subjectId);
        $this->db->bindValue(":url", $url);
        $this->db->bindValue(":title", $title);
        $this->db->bindValue(":d", $duration);
        $this->db->bindValue(":n", $noteId);
        $this->db->execute();

        // insert study_session (youtube)
        $sessionModel = new \FpSmt3\WebTracker\Models\StudySessionModel();

        $end = new \DateTime();
        $start = (clone $end)->modify("-{$duration} minutes");

        $sessionModel->addSessionFromArray([
            'user_id' => $userId,
            'subject_id' => $subjectId,
            'activity_id' => null,
            'start_time' => $start->format('Y-m-d H:i:s'),
            'end_time' => $end->format('Y-m-d H:i:s'),
            'duration_minutes' => $duration,
            'productivity_level' => 'medium',
        ]);
    }

    public function hasActivityToday($userId)
    {
        $this->db->query("
        SELECT COUNT(*) AS total
        FROM youtube_activity
        WHERE user_id = ?
        AND DATE(created_at) = CURDATE()
    ");
        $this->db->bindValue(1, $userId);
        $row = $this->db->single();
        return (int)$row['total'] > 0;
    }

    public function addActivityOnly($userId, $subjectId, $url, $title, $duration, $noteId)
    {
        $this->db->query("
        INSERT INTO youtube_activity
        (user_id, subject_id, video_url, video_title, duration_minutes, note_id, created_at)
        VALUES (:u, :s, :url, :title, :d, :n, NOW())
    ");

        $this->db->bindValue(':u', $userId);
        $this->db->bindValue(':s', $subjectId);
        $this->db->bindValue(':url', $url);
        $this->db->bindValue(':title', $title);
        $this->db->bindValue(':d', $duration);
        $this->db->bindValue(':n', $noteId);
        $this->db->execute();
    }


    public function recentYoutubeSessions($userId)
    {
        $this->db->query("
            SELECT yt.*, s.subject_name
            FROM youtube_activity yt
            LEFT JOIN subjects s ON yt.subject_id = s.id_subject
            WHERE yt.user_id = :id
            ORDER BY yt.created_at DESC
            LIMIT 6
        ");

        $this->db->bindValue(":id", $userId);
        return $this->db->resultSet();
    }
    public function totalYoutubeThisWeek($userId)
    {
        $this->db->query("
        SELECT SUM(duration_minutes) AS total
        FROM youtube_activity
        WHERE user_id = :uid
        AND YEARWEEK(created_at, 1) = YEARWEEK(NOW(), 1)
    ");
        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();
        return $row ? intval($row['total']) : 0;
    }
    public function totalYoutubeToday($userId)
    {
        $this->db->query("
        SELECT COALESCE(SUM(duration_minutes), 0) AS total
        FROM youtube_activity
        WHERE user_id = :uid
        AND created_at >= CURDATE()
        AND created_at < CURDATE() + INTERVAL 1 DAY
    ");

        $this->db->bindValue(':uid', $userId);
        $row = $this->db->single();

        return (int) $row['total'];
    }
}
