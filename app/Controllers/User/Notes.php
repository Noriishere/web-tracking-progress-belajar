<?php
namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\UserNotesModel;
use FpSmt3\WebTracker\Models\UserStreakModel;

class Notes extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

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
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $data['judul'] = 'Tambah Catatan';
        $this->view('user/utility/header', $data);
        $this->view('user/notes/add', $data);
        $this->view('user/utility/footer', $data);
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $userId = $_SESSION['user']['id_user'];
        $content = $_POST['content'];
        $wordCount = str_word_count($content);

        $model = new UserNotesModel();
        $model->addNote($userId, $content, $wordCount);

        $streak = new UserStreakModel();
        $streak->updateStreak($userId);

        header('Location: ' . BASE_URL . 'notes');
        exit;
    }

    public function detail($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $model = new UserNotesModel();
        $data['judul'] = 'Detail Catatan';
        $data['note'] = $model->getNoteById($id);

        $this->view('user/utility/header', $data);
        $this->view('user/notes/detail', $data);
        $this->view('user/utility/footer', $data);
    }

    public function delete($id)
    {
        $model = new UserNotesModel();
        $model->deleteNote($id);
        header('Location: ' . BASE_URL . 'notes');
        exit;
    }

    public function autosave()
    {
        $userId = $_SESSION['user']['id_user'];
        $content = $_POST['content'];
        $noteId = $_POST['note_id'] ?? null;

        $model = new UserNotesModel();

        if ($noteId) {
            $model->updateNoteContent($noteId, $content);
            echo json_encode(["status" => "updated"]);
            exit;
        }

        $wordCount = str_word_count($content);
        $newId = $model->addNote($userId, $content, $wordCount);

        echo json_encode(["status" => "new", "id" => $newId]);
        exit;
    }
}
