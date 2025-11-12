<?php
namespace FpSmt3\WebTracker\Controllers\Admin;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\AdminModel;

class AdminAuth extends Controller {
    
    public function index() {
        $this->login();
    }
    
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $adminModel = new AdminModel();
            $admin = $adminModel->getAdminByUsername($username);
            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'nama_admin' => $admin['nama_admin'],
                    'username' => $admin['username']
                ];

                header('Location: ' . BASE_URL . 'admin/dashboard');
                exit;
            } else {
                $data['error'] = "Username atau password salah!";
            }
        }

        $data['judul'] = "Login Admin";
        $this->view('admin/auth/login', $data);
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['admin']);
        session_destroy();
        header('Location: ' . BASE_URL . 'admin/adminauth/login');
        exit;
    }
}