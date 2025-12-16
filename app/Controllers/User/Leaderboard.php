<?php
namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;

class Leaderboard extends Controller
{
    public function index()
    {
        $data['judul'] = 'Leaderboard';

        $this->view('user/utility/header', $data);
        $this->view('user/leaderboard/index', $data);
        $this->view('user/utility/footer', $data);
    }
}
