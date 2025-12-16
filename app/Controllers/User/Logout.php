<?php
namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;

class Logout extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/auth/login');
            exit;
        }
        session_destroy();
        header('Location: ' . BASE_URL . 'user/auth/login');
        exit;
    }
}
