<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Core\Mailer;
use FpSmt3\WebTracker\Models\UserModel;
use FpSmt3\WebTracker\Models\SecurityLogModel;
use FpSmt3\WebTracker\Core\WebPushServices;

class Auth extends Controller
{
    private UserModel $userModel;
    private SecurityLogModel $logModel;
    
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->userModel = new UserModel();
        $this->logModel  = new SecurityLogModel();
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/dashboard');
            exit;
        }

        $this->view('user/auth/login', [
            'judul' => 'Login | Web Tracker'
        ]);
    }

    public function handleRequest()
    {
        $action = $_GET['action'] ?? $_POST['action'] ?? '';

        match ($action) {
            'register'      => $this->register(),
            'verify'        => $this->verify(),
            'checkUsername' => $this->checkUsername(),
            'login'         => $this->login(),
            default         => http_response_code(404)
        };
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        header('Content-Type: application/json');

        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $ip = $_SERVER['REMOTE_ADDR'];

        $ip = $_SERVER['REMOTE_ADDR'] === '::1'
            ? '127.0.0.1'
            : $_SERVER['REMOTE_ADDR'];

            
            if (!$email || !$password) {
            echo json_encode(['status' => 'error', 'message' => 'Email dan password wajib diisi']);
            return;
        }

        $user = $this->userModel->getUserByEmail($email);
        $path = $_SERVER['REQUEST_URI'];
        if (!$user) {
            $this->logModel->log(
                null,
                'login',
                'failed',
                $path,
                [
                    'email' => $email,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
                ],
                $ip
            );
            echo json_encode([
                'status' => 'error',
                'message' => 'Akun tidak ditemukan'
            ]);
            return;
        }

        if (!password_verify($password, $user['password'])) {
            $this->logModel->log(
                $user['id_user'],
                'login',
                'failed',
                $path,
                [
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
                ],
                $ip,
            );
            
            $attempts = $this->logModel->countRecentFailures('login', $ip, 5);
    
            if ($attempts >= 5) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Akun/IP diblokir sementara karena terlalu banyak gagal login. Coba lagi 20 menit lagi.'
                ]);
                return;
            }
            echo json_encode(['status' => 'error', 'message' => 'Password salah']);
            return;
        }

        $profile = $this->userModel->getProfile($user['id_user']);

        $_SESSION['user'] = [
            'id_user'   => $user['id_user'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'image'     => $profile['image'] ?? null,
            'firstname' => $profile['firstname'] ?? null,
            'lastname'  => $profile['lastname'] ?? null
        ];

        $this->logModel->log($user['id_user'], 'login', 'success', $path, [], $ip);

        echo json_encode([
            'status'   => 'success',
            'message'  => 'Login berhasil',
            'redirect' => $profile
                ? BASE_URL . 'user/dashboard'
                : BASE_URL . 'user/profile/edit'
        ]);
    }

    private function register()
    {
        header('Content-Type: application/json');
        $path = $_SERVER['REQUEST_URI'];
        $data = [
            'username' => $_POST['username'] ?? '',
            'email'    => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];

        if (!$data['username'] || !$data['email'] || !$data['password']) {
            echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi']);
            return;
        }

        $result = $this->userModel->registerUser($data);

        if ($result === 'duplicate') {
            echo json_encode(['status' => 'error', 'message' => 'Username atau email sudah terdaftar']);
            return;
        }

        if ($result > 0) {
            $token = bin2hex(random_bytes(32));
            $this->userModel->saveToken($data['email'], $token);

            $link = BASE_URL . 'user/auth/handleRequest?action=verify&token=' . $token;

            Mailer::sendVerification($data['email'], $data['username'], $link);

            $this->logModel->log(null, 'register', 'success', $path,['email' => $data['email']]);

            echo json_encode([
                'status'  => 'success',
                'message' => 'Registrasi berhasil, cek email untuk verifikasi'
            ]);
        }
    }

    private function verify()
    {   $path = $_SERVER['REQUEST_URI'];
        $token = $_GET['token'] ?? '';

        if (!$token) {
            echo 'Token tidak valid';
            return;
        }

        $email = $this->userModel->getEmailByToken($token);

        if (!$email) {
            echo 'Token tidak valid atau sudah digunakan';
            return;
        }

        $this->userModel->verifyUser($email);
        $this->logModel->log(null, 'verify', 'success', $path, ['email' => $email]);

        echo 'Akun berhasil diverifikasi';
    }

    public function forgot()
    {
        header('Content-Type: application/json');
        $path = $_SERVER['REQUEST_URI'];
        $email = $_POST['email'] ?? '';
        $user  = $this->userModel->getUserByEmail($email);

        if (!$user) {
            $this->logModel->log(null, 'password_reset_request', 'failed', $path, ['email' => $email]);
            echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan']);
            return;
        }

        $token  = bin2hex(random_bytes(32));
        $expire = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $this->userModel->createResetToken($user['id_user'], $token, $expire);

        $link = BASE_URL . 'user/auth/reset?token=' . $token;

        Mailer::sendResetPassword($email, $user['username'], $link);

        (new WebPushServices())->sendByUserId(
            $user['id_user'],
            'Reset Password',
            'Klik link untuk reset password akun kamu'
        );

        $this->logModel->log($user['id_user'], 'password_reset_request', 'success', $path);

        echo json_encode(['status' => 'success', 'message' => 'Link reset dikirim']);
    }

    public function reset()
    {
        $this->view('user/auth/reset', [
            'token' => $_GET['token'] ?? ''
        ]);
    }

    public function resetSave()
    {
        header('Content-Type: application/json');

        $token = $_POST['token'] ?? '';
        $pass  = $_POST['password'] ?? '';
        $path = $_SERVER['REQUEST_URI'];
        $reset = $this->userModel->getResetByToken($token);

        if (!$reset) {
            $this->logModel->log(null, 'password_reset', 'failed', $path, ['token' => $token]);
            echo json_encode(['status' => 'error', 'message' => 'Token tidak valid']);
            return;
        }

        $this->userModel->updatePassword('user', $reset['user_id'], $pass);
        $this->userModel->markResetUsed($reset['id']);

        $this->logModel->log($reset['user_id'], 'password_reset', 'success', $path);

        echo json_encode(['status' => 'success', 'message' => 'Password berhasil diubah']);
    }

    public function checkUsername()
    {
        $username = $_GET['username'] ?? '';

        echo json_encode([
            'available' => !$this->userModel->getUserByUsername($username)
        ]);
    }
}
