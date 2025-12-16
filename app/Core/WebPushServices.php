<?php

namespace FpSmt3\WebTracker\Core;

use Base64Url\Base64Url;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use FpSmt3\WebTracker\Models\UserPushSubscriptionModel;

class WebPushServices
{
    private $webPush;
    private $model;

    public function __construct()
    {
        $this->model = new UserPushSubscriptionModel();

        // Konfigurasi VAPID
        $auth = [
            'VAPID' => [
                'subject' => VAPID_SUBJECT,
                'publicKey' => VAPID_PUBLIC_KEY,
                'privateKey' => VAPID_PRIVATE_KEY,
            ]
        ];

        $this->webPush = new WebPush($auth);
    }

    public function sendByUserId($userId, $title, $body, $url = '/', $options = [])
{
    $subscriptions = $this->model->getByUser($userId);

    if (empty($subscriptions)) {
        return ['success' => false, 'message' => 'No subscriptions'];
    }

    $payload = $this->buildPayload($title, $body, $url, $options);

    $results = ['success' => 0, 'failed' => 0];

    foreach ($subscriptions as $sub) {
        $subscription = Subscription::create([
            'endpoint' => $sub['endpoint'],
            'keys' => [
                'p256dh' => $sub['p256dh'],
                'auth' => $sub['auth']
            ]
        ]);

        $this->webPush->queueNotification($subscription, $payload);
    }

    foreach ($this->webPush->flush() as $report) {
        if ($report->isSuccess()) {
            $results['success']++;
        } else {
            $results['failed']++;

            if ($report->isSubscriptionExpired()) {
                $endpoint = $report->getRequest()->getUri()->__toString();
                $this->model->deleteByEndpoint($endpoint);
            }
        }
    }

    return $results;
}
private function buildPayload($title, $body, $url, $options = [])
{
    return json_encode([
        'notification' => [
            'title' => $title,
            'body'  => $body,
            'icon'  => $options['icon'] ?? BASE_URL . '/logo.png',
            'badge' => $options['badge'] ?? BASE_URL . '/badge.png',
            'data'  => [
                'url' => $url
            ],
            'tag' => 'webtracker',
            'requireInteraction' => false
        ]
    ]);
}

    public function sendToAll($title, $body, $data = [])
    {
        // Implementasi jika diperlukan
    }
}
