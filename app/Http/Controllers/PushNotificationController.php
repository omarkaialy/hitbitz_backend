<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class PushNotificationController extends Controller
{

    public function sendPushNotification(string $title,string $body,string $topic)
    {
        try {
            $firebase = (new Factory)
                ->withServiceAccount(config_path('firebase_credentials.json'));

            $messaging = $firebase->createMessaging();

            $message = CloudMessage::fromArray([
                'notification' => [
                    'title' => $title,
                    'body' => $body
                ],
                'topic' => $topic
            ]);

            $messaging->send($message);

            return true;
        }
    catch (\Exception $exception){
            return $exception;
    }
    }
}
