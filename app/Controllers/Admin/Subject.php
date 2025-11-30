<?php
namespace FpSmt3\WebTracker\Controllers\Admin;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\SubjectModel;

class Subject extends Controller
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin'])) {
            header("Location: " . BASE_URL . "admin/adminauth");
            exit;
        }

        $this->model = new SubjectModel();
    }

    public function index()
    {
        $data['judul'] = "Subjects";
        $data['subjects'] = $this->model->getAllSubjects();
        $data['user'] = $_SESSION['admin']['nama_admin'];

        $this->view('admin/utility/header', $data);
        $this->view('admin/subjects/index', $data);
        $this->view('admin/utility/footer', $data);
    }

    public function add()
    {
        $data['judul'] = "Tambah Mata Kuliah";
        $this->view('admin/utility/header', $data);
        $this->view('admin/subjects/add', $data);
        $this->view('admin/utility/footer', $data);
    }

    public function store()
    {
        $name = $_POST['subject_name'];

        $this->model->addSubject($name);
        header("Location: " . BASE_URL . "admin/subject");
        exit;
    }

    public function edit($id)
    {
        $data['judul'] = "Edit Mata Kuliah";
        $data['subject'] = $this->model->getById($id);

        $this->view('admin/utility/header', $data);
        $this->view('admin/subjects/edit', $data);
        $this->view('admin/utility/footer', $data);
    }

    public function update($id)
    {
        $name = $_POST['subject_name'];

        $this->model->updateSubject($id, $name);

        header("Location: " . BASE_URL . "admin/subject");
        exit;
    }

    public function delete($id)
    {
        $this->model->deleteSubject($id);
        header("Location: " . BASE_URL . "admin/subject");
        exit;
    }
}
