<?php
namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserProgressModel extends Database
{
    public function durationToday($userId)
    {
        $this->query("SELECT SUM(duration_minutes) AS total FROM user_progress WHERE user_id = ? AND study_date = CURDATE()");
        $this->bindValue(1, $userId);
        $data = $this->single();
        return $data['total'] ?? 0;
    }
}
