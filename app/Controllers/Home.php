<?php
namespace FpSmt3\WebTracker\Controllers;

use FpSmt3\WebTracker\Core\Controller;

class Home extends Controller {
    public function index(){
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/dashboard');
            exit;
        }
        $this->view('app/index');
    }
}