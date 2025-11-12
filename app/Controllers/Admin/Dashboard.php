<?php
namespace FpSmt3\WebTracker\Controllers\Admin;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\UserModel;

class Dashboard extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
            header('Location: '. BASE_URL .'admin/adminauth'); 
            exit;
        }

        $data['judul'] = "Dashboard";
        $data['user'] = $_SESSION['admin']['nama_admin'];
        
        $userModel = new UserModel(); 
        $data['all_user'] = $userModel->getAllAdmin();

        $this->view('admin/utility/header', $data);
        $this->view('admin/dashboard/index', $data);
        $this->view('admin/utility/footer', $data);
    }
}