<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserPushSubscriptionModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function save(
        int $userId,
        string $endpoint,
        string $p256dh,
        string $auth
    ): void {
        $this->db->query("
            INSERT INTO user_push_subscriptions (user_id, endpoint, p256dh, auth)
            VALUES (:uid, :endpoint, :p256dh, :auth)
            ON DUPLICATE KEY UPDATE
                user_id = VALUES(user_id),
                p256dh  = VALUES(p256dh),
                auth    = VALUES(auth)
        ");

        $this->db->bindValue(':uid', $userId);
        $this->db->bindValue(':endpoint', $endpoint);
        $this->db->bindValue(':p256dh', $p256dh);
        $this->db->bindValue(':auth', $auth);

        $this->db->execute();
    }

    public function getByUser(int $userId): array
    {
        $this->db->query("
            SELECT endpoint, p256dh, auth
            FROM user_push_subscriptions
            WHERE user_id = :uid
        ");

        $this->db->bindValue(':uid', $userId);
        return $this->db->resultSet();
    }

    public function deleteByEndpoint(string $endpoint): void
    {
        $this->db->query("
            DELETE FROM user_push_subscriptions
            WHERE endpoint = :endpoint
        ");

        $this->db->bindValue(':endpoint', $endpoint);
        $this->db->execute();
    }
}