<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Models\StudyRecommendationModel;
use FpSmt3\WebTracker\Models\UserModel;
use FpSmt3\WebTracker\Models\UserNotesModel;
use FpSmt3\WebTracker\Models\UserStreakModel;
use FpSmt3\WebTracker\Models\UserProgressModel;
use FpSmt3\WebTracker\Models\UserSubjectModel;
use FpSmt3\WebTracker\Models\StudySessionModel;
use FpSmt3\WebTracker\Models\YoutubeActivityModel;

class Dashboard extends Controller
{
    private $userModel;
    private $userSubjectModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'user/auth/login');
            exit;
        }

        $this->userModel = new UserModel();
        $this->userSubjectModel = new UserSubjectModel();
    }

    public function index()
    {
        $userId = $_SESSION['user']['id_user'];

        if (!$this->userModel->hasProfile($userId)) {
            header("Location: " . BASE_URL . "user/profile/edit");
            exit;
        }

        if (count($this->userSubjectModel->getSubjectsByUser($userId)) === 0) {
            header("Location: " . BASE_URL . "user/profile/subjects");
            exit;
        }

        $notesModel     = new UserNotesModel();
        $progressModel  = new UserProgressModel();
        $streakModel    = new UserStreakModel();
        $sessionModel   = new StudySessionModel();
        $youtubeModel   = new YoutubeActivityModel();
        $recommendModel = new StudyRecommendationModel();

        $data['judul']    = "Dashboard";
        $data['username'] = $_SESSION['user']['username'];

        $data['notes_today']    = $notesModel->countToday($userId);
        $data['word_today']     = $notesModel->wordToday($userId);
        $data['recent_notes']   = $notesModel->recentNotes($userId);

        $data['streak']         = $streakModel->getCurrentStreak($userId);
        $data['longest_streak'] = $streakModel->getLongestStreak($userId);

        $pomodoroToday = $progressModel->durationToday($userId);
        $youtubeToday  = $youtubeModel->totalYoutubeToday($userId);
        $data['duration_today'] = $pomodoroToday + $youtubeToday;

        $chart = $sessionModel->chartLast7Days($userId);
        $data['session_chart_labels'] = $chart['labels'];
        $data['session_chart_data']   = $chart['data'];

        $data['recent_sessions'] = $sessionModel->recentSessions($userId);
        $data['recent_youtube']  = $youtubeModel->recentYoutubeSessions($userId);
        $data['total_sessions'] = $sessionModel->totalSessions($userId);
        $data['productive_day']    = $sessionModel->mostProductiveDay($userId);
        $data['weekly_minutes']    = $sessionModel->totalMinutesThisWeek($userId);
        $data['last_week_minutes'] = $sessionModel->totalMinutesLastWeek($userId);
        $data['weekly_growth']     = $this->calculateGrowth(
            $data['last_week_minutes'],
            $data['weekly_minutes']
        );

        $data['top_subject']     = $sessionModel->topSubject($userId);
        $data['youtube_minutes'] = $youtubeModel->totalYoutubeThisWeek($userId);

        $bestHour = $sessionModel->bestHour($userId);
        $productiveDay = $sessionModel->mostProductiveDay($userId);

        if ($bestHour !== null && $productiveDay !== null) {
            $recommendModel->saveRecommendation(
                $userId,
                $bestHour . ':00',
                $productiveDay
            );
        }

        $rec = $recommendModel->getByUser($userId);
        $data['rec_best_hour'] = $rec['best_hour'] ?? null;
        $data['rec_day']       = $rec['most_productive_day'] ?? null;

        $this->view('user/utility/header', $data);
        $this->view('user/dashboard/index', $data);
        $this->view('user/utility/footer', $data);
    }

    private function calculateGrowth($last, $now)
    {
        if ($last == 0) return $now > 0 ? 100 : 0;
        return round((($now - $last) / $last) * 100);
    }
}
