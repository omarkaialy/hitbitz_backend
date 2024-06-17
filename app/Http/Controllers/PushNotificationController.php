<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class PushNotificationController extends Controller
{

    public function sendPushNotification(string $title, string $body, string $topic, $imageUrl = null)
    {

        try {
            $firebase = (new Factory)
                ->withServiceAccount(config_path('firebase_credentials.json'));

            $messaging = $firebase->createMessaging();
            $notification = Notification::create($title, $body, $imageUrl);
            $message = CloudMessage::fromArray([
                'notification' => $notification,
                'topic' => $topic
            ]);
            $messaging->send($message);

            return $message;
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
