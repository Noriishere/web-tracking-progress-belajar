<?php
namespace FpSmt3\WebTracker\Controllers\Admin;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\AdminDashboardModel;
use FpSmt3\WebTracker\Models\UserModel;

class Dashboard extends Controller
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . 'admin/adminauth');
            exit;
        }
        $this->model = new AdminDashboardModel();
    }

    public function index()
    {
        $data['judul'] = "Admin Dashboard";
        $data['admin_name'] = $_SESSION['admin']['nama_admin'];

        $data['total_users'] = $this->model->getTotaluser();
        $data['total_sessions'] = $this->model->getTotalSessions();
        $data['total_youtube'] = $this->model->getTotalYoutubeActivities();
        $data['total_subjects'] = $this->model->getTotalSubjects();

        $chart = $this->model->chartSessionsLast7Days();
        $data['session_chart_labels'] = $chart['labels'];
        $data['session_chart_data'] = $chart['data'];

        $data['recent_users'] = $this->model->recentuser();
        $data['recent_sessions'] = $this->model->recentSessions();
        $data['recent_youtube'] = $this->model->recentYoutube();

        $this->view('admin/utility/header', $data);
        $this->view('admin/dashboard/index', $data);
        $this->view('admin/utility/footer', $data);
    }
}