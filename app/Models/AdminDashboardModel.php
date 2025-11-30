<?php
namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class AdminDashboardModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTotaluser()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM user");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    public function getTotalSessions()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM study_sessions");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    public function getTotalYoutubeActivities()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM youtube_activity");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    public function getTotalSubjects()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM subjects");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    public function chartSessionsLast7Days()
    {
        $this->db->query("
            SELECT DATE(start_time) AS tanggal, COALESCE(SUM(duration_minutes),0) AS total
            FROM study_sessions
            WHERE start_time >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY DATE(start_time)
            ORDER BY tanggal ASC
        ");
        $rows = $this->db->resultSet();

        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = date("Y-m-d", strtotime("-$i days"));
            $labels[] = date("D", strtotime($day));
            $found = array_filter($rows, function($r) use ($day) { return $r['tanggal'] === $day; });
            $data[] = $found ? (int) array_values($found)[0]['total'] : 0;
        }
        return ['labels' => $labels, 'data' => $data];
    }

    public function recentuser($limit = 6)
    {
        $this->db->query("SELECT id_user, username, email, created_at FROM user ORDER BY created_at DESC LIMIT :lim");
        $this->db->bindValue(':lim', $limit);
        return $this->db->resultSet();
    }

    public function recentSessions($limit = 6)
    {
        $this->db->query("
            SELECT s.id_session , s.user_id, s.start_time, s.duration_minutes, a.activity_name, sub.subject_name
            FROM study_sessions s
            LEFT JOIN study_activities a ON s.activity_id = a.id_activity
            LEFT JOIN subjects sub ON s.subject_id = sub.id_subject
            ORDER BY s.start_time DESC
            LIMIT :lim
        ");
        $this->db->bindValue(':lim', $limit);
        return $this->db->resultSet();
    }

    public function recentYoutube($limit = 6)
    {
        $this->db->query("
            SELECT y.id_activity, y.user_id, y.video_title, y.duration_minutes, s.subject_name, y.created_at
            FROM youtube_activity y
            LEFT JOIN subjects s ON y.subject_id = s.id_subject
            ORDER BY y.created_at DESC
            LIMIT :lim
        ");
        $this->db->bindValue(':lim', $limit);
        return $this->db->resultSet();
    }
}
