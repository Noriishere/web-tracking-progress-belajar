<?php
namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\UserModel;
use FpSmt3\WebTracker\Models\SubjectModel;
use FpSmt3\WebTracker\Models\UserSubjectModel;

class Profile extends Controller
{
    private $userModel;
    private $subjectModel;
    private $userSubjectModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "auth/login");
            exit;
        }

        $this->userModel = new UserModel();
        $this->subjectModel = new SubjectModel();
        $this->userSubjectModel = new UserSubjectModel();
    }

    public function edit()
    {
        $data['judul'] = "Lengkapi Profil";
        $this->view('user/utility/header', $data);
        $this->view('user/profile/edit', $data);
        $this->view('user/utility/footer', $data);
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

        header("Location: " . BASE_URL . "user/profile/subjects");
        exit;
    }

    public function subjects()
    {
        $id = $_SESSION['user']['id_user'];

        $data['judul'] = "Pilih Mata Kuliah";
        $data['subjects'] = $this->subjectModel->getAllSubjects();
        $data['user_subject_ids'] = $this->userSubjectModel->getSubjectIdsByUser($id);

        $this->view('user/utility/header', $data);
        $this->view('user/profile/subjects', $data);
        $this->view('user/utility/footer', $data);
    }

    public function saveSubjects()
    {
        $id = $_SESSION['user']['id_user'];
        $subjectIds = isset($_POST['subjects']) ? $_POST['subjects'] : [];

        $this->userSubjectModel->setSubjectsForUser($id, $subjectIds);

        header("Location: " . BASE_URL . "user/dashboard");
        exit;
    }
}