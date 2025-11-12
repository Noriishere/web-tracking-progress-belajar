<?php
use FpSmt3\WebTracker\Core\Controller;
class About extends Controller{
    public function index($nama = "bagas", $pekerjaan = "programmer")
    {
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['judul'] = "About me";
        $this->view('utility/header', $data); 
        $this->view('about/index', $data);
        $this->view('utility/footer');
    }
    public function page()
    {
        echo 'about/page';
    }
}