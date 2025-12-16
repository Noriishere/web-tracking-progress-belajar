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
        $user = $this->getUserByEmail($email);

        $this->db->query("
        INSERT INTO user_verification (user_id, email, token, expired_at)
        VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 1 DAY))
    ");
        $this->db->bindValue(1, $user['id_user']);
        $this->db->bindValue(2, $email);
        $this->db->bindValue(3, $token);
        $this->db->execute();
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

    public function getProfile($userId)
    {
        $this->db->query("SELECT * FROM user_profile WHERE user_id = :id LIMIT 1");
        $this->db->bindValue('id', $userId);
        return $this->db->single();
    }

    public function insertProfile($userId, $data)
    {
        $imageName = null;

        if (isset($data['image'])) {
            $imageName = $this->uploadImage($data['image']);
        }

        $this->db->query("
        INSERT INTO user_profile (user_id, firstname, lastname, birthday, bio, image)
        VALUES (:user_id, :firstname, :lastname, :birthday, :bio, :image)
    ");

        $this->db->bindValue('user_id', $userId);
        $this->db->bindValue('firstname', $data['firstname']);
        $this->db->bindValue('lastname', $data['lastname']);
        $this->db->bindValue('birthday', $data['birthday']);
        $this->db->bindValue('bio', $data['bio']);
        $this->db->bindValue('image', $imageName);

        return $this->db->execute();
    }

    public function updateProfile($userId, $data)
    {
        $old = $this->getProfile($userId);
        $currentImage = $old['image'] ?? null;

        if (isset($data['image']) && $data['image']['error'] === UPLOAD_ERR_OK) {
            $newImage = $this->uploadImage($data['image']);
            if ($newImage) {
                $this->deleteOldImage($currentImage);
                $currentImage = $newImage;
            }
        }

        $query = "UPDATE user_profile
              SET firstname = :firstname,
                  lastname = :lastname,
                  birthday = :birthday,
                  bio = :bio,
                  image = :image
              WHERE user_id = :user_id";

        $this->db->query($query);
        $this->db->bindValue('firstname', $data['firstname']);
        $this->db->bindValue('lastname', $data['lastname']);
        $this->db->bindValue('birthday', $data['birthday']);
        $this->db->bindValue('bio', $data['bio']);
        $this->db->bindValue('image', $currentImage);
        $this->db->bindValue('user_id', $userId);

        $this->db->execute();
        return $this->db->rowCount();
    }

    private function uploadImage($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array(mime_content_type($file['tmp_name']), $allowed)) {
            return null;
        }

        if (!getimagesize($file['tmp_name'])) return null;

        $ext = 'jpg';
        $name = 'pf_' . uniqid() . '.jpg';
        $path = __DIR__ . '/../../public/img/uploads/' . $name;
        move_uploaded_file($file['tmp_name'], $path);

        return $name;
    }

    public function createResetToken($userId, $token, $expired)
    {
        $this->db->query("
        INSERT INTO password_resets (user_id, token, expires_at)
        VALUES (:uid, :token, :exp)
    ");
        $this->db->bindValue(':uid', $userId);
        $this->db->bindValue(':token', $token);
        $this->db->bindValue(':exp', $expired);
        return $this->db->execute();
    }

    public function getResetByToken($token)
    {
        $this->db->query("
        SELECT * FROM password_resets
        WHERE token = :token AND used = 0 AND expires_at > NOW()
    ");
        $this->db->bindValue(':token', $token);
        return $this->db->single();
    }

    public function markResetUsed($id)
    {
        $this->db->query("UPDATE password_resets SET used = 1 WHERE id = :id");
        $this->db->bindValue(':id', $id);
        return $this->db->execute();
    }


    private function deleteOldImage($filename)
    {
        $path = __DIR__ . '/../../public/img/uploads/' . $filename;
        if ($filename && file_exists($path)) unlink($path);
    }
}
