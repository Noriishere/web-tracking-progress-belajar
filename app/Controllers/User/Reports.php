<?php

namespace FpSmt3\WebTracker\Controllers\User;

use Dompdf\Dompdf;
use Dompdf\Options;
use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\ReportModel;

class Reports extends Controller
{
    private $reportModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/auth/login');
            exit;
        }

        $this->reportModel = new ReportModel();
    }

    public function download()
    {
        $userId = $_SESSION['user']['id_user'];

        $harian   = $this->reportModel->getProgressHarianUser($userId);
        $subject  = $this->reportModel->getProgressPerMataKuliah($userId);
        $youtube  = $this->reportModel->getRekapBelajarYoutube($userId);

        ob_start();
        require __DIR__ . '/../../Views/user/reports/pdf.php';
        $html = ob_get_clean();

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream(
            'laporan_progress_' . date('Ymd') . '.pdf',
            ['Attachment' => true]
        );
        exit;
    }
    public function progressHarian()
    {
        $userId = $_SESSION['user']['id_user'];

        $data['judul'] = 'Progress Harian';
        $data['data']  = $this->reportModel->getProgressHarianUser($userId);
        $data['harian']        = $this->reportModel->getProgressHarianUser($userId);
        $data['perMataKuliah'] = $this->reportModel->getProgressPerMataKuliah($userId);
        $data['youtube']       = $this->reportModel->getRekapBelajarYoutube($userId);

        $this->view('user/utility/header', $data);
        $this->view('user/reports/progress', $data);
        $this->view('user/utility/footer');
    }

    public function progressMataKuliah()
    {
        $userId = $_SESSION['user']['id_user'];

        $data['judul'] = 'Progress per Mata Kuliah';
        $data['data']  = $this->reportModel->getProgressPerMataKuliah($userId);

        $this->view('user/utility/header', $data);
        $this->view('user/reports/progress_mata_kuliah', $data);
        $this->view('user/utility/footer');
    }

    public function rekapYoutube()
    {
        $userId = $_SESSION['user']['id_user'];

        $data['judul'] = 'Rekap Belajar YouTube';
        $data['data']  = $this->reportModel->getRekapBelajarYoutube($userId);

        $this->view('user/utility/header', $data);
        $this->view('user/reports/rekap_youtube', $data);
        $this->view('user/utility/footer');
    }
}
