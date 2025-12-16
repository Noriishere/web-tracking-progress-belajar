<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\StudySessionModel;
use FpSmt3\WebTracker\Models\UserSubjectModel;
use FpSmt3\WebTracker\Models\UserNotesModel;
use FpSmt3\WebTracker\Models\StudyActivityModel;
use FpSmt3\WebTracker\Models\YoutubeActivityModel;
use FpSmt3\WebTracker\Models\SubjectModel;
use FpSmt3\WebTracker\Models\UserStreakModel;

class Sessions extends Controller
{
    private StudySessionModel $sessionModel;
    private UserSubjectModel $userSubjectModel;
    private UserNotesModel $notesModel;
    private StudyActivityModel $activityModel;
    private SubjectModel $subjectModel;
    private UserStreakModel $streakModel;
    private YoutubeActivityModel $youtubeModel;

    private string $viewHeader = 'user/utility/header';
    private string $viewFooter = 'user/utility/footer';
    private string $viewStudy = 'user/sessions/study';
    private string $viewYoutube = 'user/sessions/youtube';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "user/auth/login");
            exit;
        }

        $this->sessionModel     = new StudySessionModel();
        $this->userSubjectModel = new UserSubjectModel();
        $this->notesModel       = new UserNotesModel();
        $this->activityModel    = new StudyActivityModel();
        $this->subjectModel     = new SubjectModel();
        $this->streakModel      = new UserStreakModel();
        $this->youtubeModel     = new YoutubeActivityModel();
    }

    public function study()
    {
        $userId = $_SESSION['user']['id_user'];

        $data = [
            'judul'      => 'Mulai Belajar',
            'subjects'   => $this->userSubjectModel->getSubjectsByUser($userId),
            'notes'      => $this->notesModel->getAllNotes($userId),
            'activities' => $this->activityModel->getAll()
        ];

        $this->view($this->viewHeader, $data);
        $this->view($this->viewStudy, $data);
        $this->view($this->viewFooter, $data);
    }

    public function youtube()
    {
        $userId = $_SESSION['user']['id_user'];

        $data = [
            'judul'       => 'Belajar dari YouTube',
            'subjects'    => $this->userSubjectModel->getSubjectsByUser($userId),
            'notes'       => $this->notesModel->getAllNotes($userId),
            'subjectMeta' => $this->subjectModel->getAll()
        ];

        $this->view($this->viewHeader, $data);
        $this->view($this->viewYoutube, $data);
        $this->view($this->viewFooter, $data);
    }

    public function storeYoutube()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
            return;
        }

        $userId     = $_SESSION['user']['id_user'];
        $videoUrl   = $_POST['video_url'] ?? '';
        $videoTitle = $_POST['video_title'] ?? '';
        $duration   = (int) ($_POST['duration'] ?? 0);
        $noteId     = $_POST['note_id'] ?? null;
        $subjectId  = $_POST['subject_id'] ?? null;

        if (!$videoUrl || !$subjectId || !$noteId || $duration <= 0) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        $note = $this->notesModel->getNoteById($noteId);

        if (!$note || str_word_count(strip_tags($note['content'])) < 10) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Catatan tidak valid']);
            return;
        }

        $this->youtubeModel->addActivityOnly(
            $userId,
            $subjectId,
            $videoUrl,
            $videoTitle,
            $duration,
            $noteId
        );

        $end   = date('Y-m-d H:i:s');
        $start = date('Y-m-d H:i:s', strtotime("-{$duration} minutes"));

        if (!$this->sessionModel->hasSessionToday($userId)) {
            $this->sessionModel->addSession(
                $userId,
                $subjectId,
                2, // activity_id youtube
                $start,
                $end,
                $duration,
                'medium'
            );

            $this->streakModel->updateStreak($userId);
        }

        $this->streakModel->updateStreak($userId);

        echo json_encode(['status' => 'ok']);
    }

    public function getPlaylistVideos()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $playlistId = $_POST['playlist_id'] ?? null;

        if (!$playlistId) {
            http_response_code(400);
            echo json_encode(['error' => 'playlist_id missing']);
            exit;
        }

        $url = "https://www.googleapis.com/youtube/v3/playlistItems"
            . "?part=snippet,contentDetails"
            . "&maxResults=50"
            . "&playlistId={$playlistId}"
            . "&key=" . YOUTUBE_API_KEY;

        header("Content-Type: application/json");
        echo file_get_contents($url);
        exit;
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'user/sessions/study');
            return;
        }

        $userId   = $_SESSION['user']['id_user'];

        $subject  = $_POST['subject_id'] ?? null;
        $activity = $_POST['activity_id'] ?? null;
        $start    = $_POST['start_time'] ?? null;
        $end      = $_POST['end_time'] ?? null;
        $duration = $_POST['duration_minutes'] ?? 0;
        $level    = $_POST['productivity_level'] ?? 'medium';

        if (!$subject || !$activity || !$start || !$end || $duration <= 0) {
            header('Location: ' . BASE_URL . 'user/sessions/study');
            return;
        }

        if ($this->sessionModel->hasSessionToday($userId)) {
            header('Location: ' . BASE_URL . 'user/dashboard');
            return;
        }

        $this->sessionModel->addSession(
            $userId,
            $subject,
            $activity,
            $start,
            $end,
            $duration,
            $level
        );

        $this->streakModel->updateStreak($userId);

        header('Location: ' . BASE_URL . 'user/dashboard');
    }
}
