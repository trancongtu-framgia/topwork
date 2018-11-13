<?php

namespace App\Classes;

use Pusher\Pusher;

class PushNotificationService
{
    public function getPushNotificationService()
    {
        $pusherDriver = config('broadcasting.connections.pusher');

        $pusher = new Pusher(
            $pusherDriver['key'],
            $pusherDriver['secret'],
            $pusherDriver['app_id'],
            $pusherDriver['options']
        );

        return $pusher;
    }

    public function sendNotification($channel, $event, $content)
    {
        try {
            $pusher = $this->getPushNotificationService();
            $pusher->trigger($channel, $event, $content);

            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
