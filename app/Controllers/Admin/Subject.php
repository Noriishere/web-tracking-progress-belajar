<?php


namespace FpSmt3\WebTracker\Controllers\Admin;


use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\SubjectModel;


class Subject extends Controller
{
    private $model;


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . 'admin/adminauth');
            exit;
        }
        $this->model = new SubjectModel();
    }


    public function index()
    {
        $data['judul'] = 'Manage Subjects';
        $data['subjects'] = $this->model->getAll();
        $this->view('admin/utility/header', $data);
        $this->view('admin/subjects/index', $data);
        $this->view('admin/utility/footer', $data);
    }


    public function add()
    {
        $data['judul'] = 'Add Subject';
        $this->view('admin/utility/header', $data);
        $this->view('admin/subjects/form', $data);
        $this->view('admin/utility/footer', $data);
    }


    public function store()
    {
        $name = $_POST['subject_name'] ?? '';
        $playlist = $_POST['youtube_playlist_id'] ?? null;
        $this->model->add($name, $playlist);
        header('Location: ' . BASE_URL . 'admin/subject/index');
        exit;
    }


    public function edit($id)
    {
        $data['judul'] = 'Edit Subject';
        $data['subject'] = $this->model->getById($id);
        $this->view('admin/utility/header', $data);
        $this->view('admin/subjects/form', $data);
        $this->view('admin/utility/footer', $data);
    }


    public function update($id)
    {
        $name = $_POST['subject_name'] ?? '';
        $playlist = $_POST['youtube_playlist_id'] ?? null;
        $this->model->update($id, $name, $playlist);
        header('Location: ' . BASE_URL . 'admin/subject');
        exit;
    }


    public function delete($id)
    {
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'admin/subject/index');
        exit;
    }
}
