<?php
namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class AdminModel {
    private $db;
    private $tb = 'admin';

    public function __construct() {
        $this->db = new Database;
    }

    public function getAdminByUsername($username) {
        $this->db->query("SELECT * FROM {$this->tb} WHERE username = :username");
        $this->db->bindValue('username', $username);
        return $this->db->single();
    }
}
