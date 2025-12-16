<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\UserNotesModel;
use FpSmt3\WebTracker\Models\UserStreakModel;

class Notes extends Controller
{
    private function auth()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/auth/login');
            exit;
        }
    }

    public function index()
    {
        $this->auth();

        $userId = $_SESSION['user']['id_user'];
        $model = new UserNotesModel();

        $data['judul'] = 'Catatan Saya';
        $data['notes'] = $model->getAllNotes($userId);

        $this->view('user/utility/header', $data);
        $this->view('user/notes/index', $data);
        $this->view('user/utility/footer', $data);
    }

    public function add()
    {
        $this->auth();

        $data['judul'] = 'Tambah Catatan';
        $this->view('user/utility/header', $data);
        $this->view('user/notes/add', $data);
        $this->view('user/utility/footer', $data);
    }

    public function store()
    {
        $this->auth();

        $userId  = $_SESSION['user']['id_user'];
        $content = $_POST['content'] ?? '';

        if (str_word_count(strip_tags($content)) < 10) {
            http_response_code(400);
            exit;
        }

        $model = new UserNotesModel();
        $model->addNote($userId, $content);

        $streak = new UserStreakModel();
        $streak->updateStreak($userId);

        header('Location: ' . BASE_URL . 'notes');
        exit;
    }

    public function detail($id)
    {
        $this->auth();

        $model = new UserNotesModel();

        $data['judul'] = 'Detail Catatan';
        $data['note']  = $model->getNoteById($id);

        $this->view('user/utility/header', $data);
        $this->view('user/notes/detail', $data);
        $this->view('user/utility/footer', $data);
    }

    public function delete($id)
    {
        $this->auth();

        $model = new UserNotesModel();
        $model->deleteNote($id);

        header('Location: ' . BASE_URL . 'user/notes');
        exit;
    }

    public function create()
    {
        $this->auth();

        $userId    = $_SESSION['user']['id_user'];
        $content   = $_POST['content'] ?? '';
        $subjectId = $_POST['subject_id'] ?? null;

        $model = new UserNotesModel();
        $id = $model->addNote($userId, $content, $subjectId);

        echo json_encode(['id' => $id]);
        exit;
    }

    public function save()
    {
        $this->auth();

        $noteId  = (int) ($_POST['note_id'] ?? 0);
        $content = $_POST['content'] ?? '';

        if (!$noteId) {
            http_response_code(400);
            exit;
        }

        $model = new UserNotesModel();
        $model->updateNoteContent($noteId, $content);

        echo json_encode(['status' => 'saved']);
        exit;
    }
}
