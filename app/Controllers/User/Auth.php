<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\UserModel;
use FpSmt3\WebTracker\Core\Mailer;

class Auth extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/dashboard');
            exit;
        }
        $data['judul'] = "Login | Web Tracker";
        $this->view('user/auth/login', $data);
    }

    public function handleRequest()
    {
        $action = $_GET['action'] ?? $_POST['action'] ?? '';

        switch ($action) {
            case 'register':
                $this->register();
                break;
            case 'verify':
                $this->verify();
                break;
            case 'checkUsername':
                $this->checkUsername();
                break;
            case 'login':
                $this->login();
                break;
            default:
                echo "404 - Action not found.";
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $data['judul'] = "Login | Web Tracker";
            $this->view('user/auth/login', $data);
            return;
        }

        ob_clean();
        header('Content-Type: application/json');

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Email dan password wajib diisi!']);
            exit;
        }

        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'Akun tidak ditemukan!']);
            exit;
        }

        if ($user['verified'] !== 'verified') {
            echo json_encode(['status' => 'error', 'message' => 'Akun belum diverifikasi.']);
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Password salah!']);
            exit;
        }

        $_SESSION['user'] = $user;

        $profile = $this->userModel->hasProfile($user['id_user']);

        $redirect = $profile
            ? BASE_URL . "user/dashboard"
            : BASE_URL . "user/profile/edit";

        echo json_encode([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'redirect' => $redirect
        ]);
        exit;
    }


    private function register()
    {
        $data = [
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
        ];

        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi!']);
            return;
        }

        $result = $this->userModel->registerUser($data);

        if ($result === 'duplicate') {
            echo json_encode(['status' => 'error', 'message' => 'Email atau username sudah terdaftar.']);
            return;
        }

        if ($result > 0) {
            $token = md5(uniqid(rand(), true));
            $this->userModel->saveToken($data['email'], $token);

            // 🔥 FIX URL VERIFIKASI
            $link = BASE_URL . "user/auth/handleRequest?action=verify&token=" . $token;

            $mailSent = Mailer::sendVerification($data['email'], $data['username'], $link);

            if ($mailSent) {
                echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil! Silakan cek email untuk verifikasi.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim email verifikasi.']);
            }
        }
    }

    private function verify()
    {
        $token = $_GET['token'] ?? '';
        if (empty($token)) {
            echo "Token tidak valid.";
            return;
        }

        $email = $this->userModel->getEmailByToken($token);

        if ($email) {
            $this->userModel->verifyUser($email);
            echo "<h3>Akun kamu berhasil diverifikasi! 🎉</h3><p>Silakan login untuk melanjutkan.</p>";
        } else {
            echo "<h3>Token tidak valid atau sudah digunakan.</h3>";
        }
    }

    public function checkUsername()
    {
        $username = $_GET['username'] ?? '';
        if (empty($username)) {
            echo json_encode(['available' => false]);
            return;
        }

        $exists = $this->userModel->getUserByUsername($username);
        echo json_encode(['available' => !$exists]);
    }
    public function save()
    {
        $id = $_SESSION['user']['id_user'];

        $data = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'birthday' => $_POST['birthday']
        ];

        $this->userModel->insertProfile($id, $data);

        echo json_encode(['status' => 'success', 'message' => 'Profil berhasil dilengkapi!']);
    }
}
