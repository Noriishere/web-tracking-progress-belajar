<?php

namespace FpSmt3\WebTracker\Controllers\User;

use FpSmt3\WebTracker\Core\Controller;
use FpSmt3\WebTracker\Core\WebPushServices;
use FpSmt3\WebTracker\Models\UserPushSubscriptionModel;

class Push extends Controller
{
    private UserPushSubscriptionModel $subscriptionModel;
    private WebPushServices $pushService;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->subscriptionModel = new UserPushSubscriptionModel();
        $this->pushService = new WebPushServices();
    }

    /**
     * Subscribe user ke push notification
     * Endpoint: POST /push/subscribe
     */
    public function subscribe(): void
    {
        $user = $_SESSION['user'] ?? null;

        if (!$user) {
            $this->jsonResponse(['message' => 'Unauthorized'], 401);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        if (
            empty($payload['endpoint']) ||
            empty($payload['keys']['p256dh']) ||
            empty($payload['keys']['auth'])
        ) {
            $this->jsonResponse(['message' => 'Invalid subscription payload'], 400);
            return;
        }

        // Simpan / update subscription (hindari duplicate endpoint)
        $this->subscriptionModel->save(
            $user['id_user'],
            $payload['endpoint'],
            $payload['keys']['p256dh'],
            $payload['keys']['auth']
        );

        $this->jsonResponse(['status' => 'ok']);
    }

    public function unsubscribe(): void
    {
        $user = $_SESSION['user'] ?? null;

        if (!$user) {
            $this->jsonResponse(['message' => 'Unauthorized'], 401);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        if (empty($payload['endpoint'])) {
            $this->jsonResponse(['message' => 'Endpoint required'], 400);
            return;
        }

        $this->subscriptionModel->deleteByEndpoint($payload['endpoint']);

        $this->jsonResponse(['status' => 'ok']);
    }

    public function test(): void
    {
        $user = $_SESSION['user'] ?? null;

        if (!$user) {
            echo 'Unauthorized';
            return;
        }

        $this->pushService->sendByUserId(
            $user['id_user'],
            'Test Push 🔔',
            'Push notification berhasil dikirim',
            '/user/dashboard'
        );

        echo 'OK';
    }

    private function jsonResponse(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
