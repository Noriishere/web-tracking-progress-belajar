<?php
namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserStreakModel extends Database
{
    public function getCurrentStreak($userId)
    {
        $this->query("SELECT current_streak FROM user_streak WHERE user_id = ?");
        $this->bindValue(1, $userId);
        $data = $this->single();
        return $data['current_streak'] ?? 0;
    }

    public function getLongestStreak($userId)
    {
        $this->query("SELECT longest_streak FROM user_streak WHERE user_id = ?");
        $this->bindValue(1, $userId);
        $data = $this->single();
        return $data['longest_streak'] ?? 0;
    }

    public function updateStreak($userId)
    {
        $this->query("SELECT current_streak, longest_streak, last_activity FROM user_streak WHERE user_id = ?");
        $this->bindValue(1, $userId);
        $data = $this->single();

        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        if (!$data) {
            $this->query("INSERT INTO user_streak (user_id, current_streak, longest_streak, last_activity) VALUES (?, 1, 1, ?)");
            $this->bindValue(1, $userId);
            $this->bindValue(2, $today);
            $this->execute();
            return;
        }

        if ($data['last_activity'] === $today) {
            return;
        }

        if ($data['last_activity'] === $yesterday) {
            $current = $data['current_streak'] + 1;
        } else {
            $current = 1;
        }

        $longest = $current > $data['longest_streak'] ? $current : $data['longest_streak'];

        $this->query("UPDATE user_streak SET current_streak = ?, longest_streak = ?, last_activity = ? WHERE user_id = ?");
        $this->bindValue(1, $current);
        $this->bindValue(2, $longest);
        $this->bindValue(3, $today);
        $this->bindValue(4, $userId);
        $this->execute();
    }
}
