<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class SecurityLogModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function log(
        ?int $userId,
        string $action,
        string $status,
        string $path,
        array $payload = [],
        ?string $ip = null
    ) {
        $this->db->query("
        INSERT INTO security_logs
        (user_id, action, status, endpoint, user_agent, ip_address, payload, created_at)
        VALUES
        (:user_id, :action, :status, :endpoint, :user_agent, :ip, :payload, NOW())
    ");

        $this->db->bindValue(':user_id', $userId);
        $this->db->bindValue(':action', $action);
        $this->db->bindValue(':status', $status);
        $this->db->bindValue(':endpoint', $path);
        $this->db->bindValue(':user_agent', $_SERVER['HTTP_USER_AGENT'] ?? null);
        $this->db->bindValue(':ip', $ip ?? $_SERVER['REMOTE_ADDR']);
        $this->db->bindValue(':payload', json_encode($payload));

        $this->db->execute();
    }


    public function countRecentFailures(string $action, string $ip, int $minutes): int
    {
        $since = date('Y-m-d H:i:s', time() - ($minutes * 60));

        $this->db->query("
        SELECT COUNT(*) AS total
        FROM security_logs
        WHERE action = :action
          AND status = 'failed'
          AND ip_address = :ip
          AND created_at >= :since
    ");

        $this->db->bindValue(':action', $action);
        $this->db->bindValue(':ip', $ip);
        $this->db->bindValue(':since', $since);

        return (int) $this->db->single()['total'];
    }
}
