<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\StudySessionModel;
use FpSmt3\WebTracker\Models\UserSubjectModel;
use FpSmt3\WebTracker\Models\UserNotesModel;
use FpSmt3\WebTracker\Models\StudyActivityModel;
use FpSmt3\WebTracker\Models\YoutubeActivityModel;

class Sessions extends Controller
{
    private $model;
    private $subjectModel;
    private $notesModel;
    private $activityModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "auth/login");
            exit;
        }

        $this->model = new StudySessionModel();
        $this->subjectModel = new UserSubjectModel();
        $this->notesModel = new UserNotesModel();
        $this->activityModel = new StudyActivityModel();
    }

    public function study()
    {
        $userId = $_SESSION['user']['id_user'];

        $data["judul"] = "Mulai Belajar";
        $data["subjects"] = $this->subjectModel->getSubjectsByUser($userId);
        $data["notes"] = $this->notesModel->getAllNotes($userId);
        $data["activities"] = $this->activityModel->getAll();

        $this->view("user/utility/header", $data);
        $this->view("user/sessions/study", $data);
        $this->view("user/utility/footer", $data);
    }

    public function youtube()
    {
        $userId = $_SESSION['user']['id_user'];

        $subjectModel = new UserSubjectModel();
        $notesModel   = new UserNotesModel();

        $data['judul'] = "Belajar dari YouTube";
        $data['subjects'] = $subjectModel->getSubjectsByUser($userId);
        $data['notes'] = $notesModel->getAllNotes($userId);

        $this->view("user/utility/header", $data);
        $this->view("user/sessions/youtube", $data);
        $this->view("user/utility/footer", $data);
    }


    public function store()
    {
        $userId = $_SESSION['user']['id_user'];
        $subjectId = $_POST['subject_id'] ?? null;
        if (!$subjectId || $subjectId === "") {
            die("Subject wajib dipilih.");
        }

        $activityId = $_POST['activity_id'] ?? null;
        $startTime = $_POST['start_time'] ?? date('Y-m-d H:i:s');
        $endTime = $_POST['end_time'] ?? date('Y-m-d H:i:s');
        $duration = isset($_POST['duration']) ? (int)$_POST['duration'] : 0;
        $productivity = $_POST['productivity'] ?? 'medium';
        $noteId = $_POST['note_id'] ?? null;

        $this->model->addSession(
            $userId,
            $subjectId,
            $activityId,
            $startTime,
            $endTime,
            $duration,
            $productivity,
            $noteId
        );

        header("Location: " . BASE_URL . "user/dashboard");
        exit;
    }
    public function storeYoutube()
    {
        $userId    = $_SESSION['user']['id_user'];
        $subjectId = $_POST['subject_id'];
        $url       = $_POST['video_url'];
        $title     = $_POST['video_title'];
        $duration  = $_POST['duration'];
        $noteId    = $_POST['note_id'] ?? null;

        $yt = new YoutubeActivityModel();
        $yt->addActivity($userId, $subjectId, $url, $title, $duration, $noteId);

        header("Location: " . BASE_URL . "user/dashboard");
        exit;
    }
}
