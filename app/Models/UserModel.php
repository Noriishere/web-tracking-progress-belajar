<?php

namespace FpSmt3\WebTracker\Models;

use FpSmt3\WebTracker\Core\Database;

class UserModel
{
    private $db;
    private $tbAdmin = 'admin';
    private $tbUser = 'user';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAdmin()
    {
        $this->db->query("SELECT * FROM {$this->tbAdmin}");
        return $this->db->resultSet();
    }

    public function getAdminById($id)
    {
        $this->db->query("SELECT * FROM {$this->tbAdmin} WHERE id = :id");
        $this->db->bindValue('id', $id);
        return $this->db->single();
    }

    public function getAdminByUsername($username)
    {
        $this->db->query("SELECT * FROM {$this->tbAdmin} WHERE username = :username");
        $this->db->bindValue('username', $username);
        return $this->db->single();
    }

    public function tambahDataAdmin($data)
    {
        $query = "INSERT INTO {$this->tbAdmin} (username, email, password, nama_admin, role)
                  VALUES (:username, :email, :password, :nama_admin, :role)";
        $this->db->query($query);
        $this->db->bindValue('username', $data['username']);
        $this->db->bindValue('email', $data['email']);
        $this->db->bindValue('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bindValue('nama_admin', $data['nama_admin']);
        $this->db->bindValue('role', $data['role']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM {$this->tbUser}");
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM {$this->tbUser} WHERE id_user = :id");
        $this->db->bindValue('id', $id);
        return $this->db->single();
    }

    public function getUserByUsername($username)
    {
        $this->db->query("SELECT * FROM {$this->tbUser} WHERE username = :username");
        $this->db->bindValue('username', $username);
        return $this->db->single();
    }

    public function registerUser($data)
    {
        // 🔎 Cek apakah username atau email sudah terdaftar
        $this->db->query("SELECT COUNT(*) as count FROM {$this->tbUser} WHERE username = :username OR email = :email");
        $this->db->bindValue('username', $data['username']);
        $this->db->bindValue('email', $data['email']);
        $existing = $this->db->single();

        if ($existing && $existing['count'] > 0) {
            return 'duplicate';
        }
        $query = "INSERT INTO {$this->tbUser} (username, email, password, verified, created_at)
                VALUES (:username, :email, :password, 'unverified', NOW())";

        $this->db->query($query);
        $this->db->bindValue('username', $data['username']);
        $this->db->bindValue('email', $data['email']);
        $this->db->bindValue('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->execute();

        return $this->db->rowCount();
    }


    public function updatePassword($table, $id, $passwordBaru)
    {
        $query = "UPDATE {$table} SET password = :password WHERE id = :id";
        $this->db->query($query);
        $this->db->bindValue('password', password_hash($passwordBaru, PASSWORD_DEFAULT));
        $this->db->bindValue('id', $id);
        return $this->db->execute();
    }

    public function deleteById($table, $id)
    {
        $this->db->query("DELETE FROM {$table} WHERE id = :id");
        $this->db->bindValue('id', $id);
        return $this->db->execute();
    }

    public function saveToken($email, $token)
    {
        $this->db->query("INSERT INTO user_verification (email, token) VALUES (:email, :token)");
        $this->db->bindValue('email', $email);
        $this->db->bindValue('token', $token);
        $this->db->execute();
        return true;
    }

    public function getEmailByToken($token)
    {
        $this->db->query("SELECT email FROM user_verification WHERE token = :token");
        $this->db->bindValue('token', $token);
        return $this->db->single()['email'] ?? false;
    }

    public function verifyUser($email)
    {
        $this->db->query("UPDATE user SET verified = 'verified' WHERE email = :email");
        $this->db->bindValue('email', $email);
        $this->db->execute();

        // Hapus token biar gak bisa dipakai ulang
        $this->db->query("DELETE FROM user_verification WHERE email = :email");
        $this->db->bindValue('email', $email);
        $this->db->execute();
    }
    public function getUserByEmail($email)
    {
        $this->db->query("SELECT * FROM {$this->tbUser} WHERE email = :email");
        $this->db->bindValue('email', $email);
        return $this->db->single();
    }

    public function hasProfile($id_user)
    {
        $this->db->query("SELECT * FROM user_profile WHERE user_id = :id");
        $this->db->bindValue('id', $id_user);
        return $this->db->single(); // jika null = belum ada profile
    }

    public function getProfileByUserId($userId)
    {
        $this->db->query("SELECT * FROM user_profile WHERE user_id = :id");
        $this->db->bindValue('id', $userId);
        return $this->db->single();
    }

    public function insertProfile($userId, $data)
    {
        $this->db->query("
        INSERT INTO user_profile (user_id, firstname, lastname, birthday, bio)
        VALUES (:user_id, :firstname, :lastname, :birthday, :bio)
    ");

        $this->db->bindValue('user_id', $userId);
        $this->db->bindValue('firstname', $data['firstname']);
        $this->db->bindValue('lastname', $data['lastname']);
        $this->db->bindValue('birthday', $data['birthday']);
        $this->db->bindValue('bio', $data['bio']);

        return $this->db->execute();
    }
    public function updateProfile($userId, $data)
    {
        $query = "UPDATE user_profile
                SET firstname = :firstname, lastname = :lastname, birthday = :birthday, bio = :bio
                WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bindValue('firstname', $data['firstname']);
        $this->db->bindValue('lastname', $data['lastname']);
        $this->db->bindValue('birthday', $data['birthday']);
        $this->db->bindValue('bio', $data['bio'] ?? '');
        $this->db->bindValue('user_id', $userId);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
