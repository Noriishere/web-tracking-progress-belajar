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
            header('Location: ' . BASE_URL . 'user/auth/login');
            exit;
        }

        $this->userModel = new UserModel();
        $this->subjectModel = new SubjectModel();
        $this->userSubjectModel = new UserSubjectModel();
    }

    public function edit()
    {
        $id = $_SESSION['user']['id_user'];

        $data['judul'] = 'Profile';
        $data['profile'] = $this->userModel->getProfileByUserId($id);
        $data['subjects'] = $this->subjectModel->getAll();
        $userSubjectModel = new UserSubjectModel();
        $user_subject_ids = $userSubjectModel->getSubjectIdsByUser($id);
        $data['user_subject_ids'] = $user_subject_ids;

        $this->view('user/utility/header', $data);
        $this->view('user/profile/edit', $data);
        $this->view('user/utility/footer', $data);
    }

    public function save()
    {
        header('Content-Type: application/json');

        $id = $_SESSION['user']['id_user'];

        $profileData = [
            'firstname' => $_POST['firstname'] ?? '',
            'lastname'  => $_POST['lastname'] ?? '',
            'birthday'  => $_POST['birthday'] ?? null,
            'bio'       => $_POST['bio'] ?? '',
            'image'     => $_FILES['image'] ?? null
        ];

        if ($this->userModel->hasProfile($id)) {
            $this->userModel->updateProfile($id, $profileData);
        } else {
            $this->userModel->insertProfile($id, $profileData);
        }

        if (isset($_POST['subjects']) && is_array($_POST['subjects'])) {
            $this->userSubjectModel->setSubjectsForUser($id, $_POST['subjects']);
        }

        $_SESSION['profile'] = $this->userModel->getProfileByUserId($id);

        echo json_encode([
            'status' => 'success',
            'message' => 'Profil & mata kuliah berhasil disimpan',
            'redirect' => BASE_URL . 'user/dashboard'
        ]);
        exit;
    }
}
