<?php
namespace FpSmt3\WebTracker\Controllers\Admin;

use FpSmt3\WebTracker\Core\Controller;

class Logout extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        session_write_close();

        header("Location: " . BASE_URL . "admin/adminauth");
        exit;
    }
}
