<?php
namespace FpSmt3\WebTracker\Controllers\Admin;

use FpSmt3\WebTracker\Core\Controller;

class Table extends Controller {
    public function index() {
        $data['judul'] = "Table";
        $data['user'] = $_SESSION['admin']['nama_admin'];
        $data['all_user'] = $this->model('UserModel')->getAlladmin();

        $this->view('admin/utility/header', $data);
        $this->view('admin/table/index', $data);
        $this->view('admin/utility/footer');
    }

    public function tambah() {
        if ($this->model('UserModel')->tambahDataUser($_POST) > 0) {
            header('Location: ' . BASE_URL . 'admin/table/index');
            exit;
        }
    }
}
