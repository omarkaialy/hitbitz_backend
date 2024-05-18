<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class PushNotificationController extends Controller
{

    public function sendPushNotification()
    {
        $firebase = (new Factory)
            ->withServiceAccount(config_path('firebase_credentials.json'));

        $messaging = $firebase->createMessaging();

        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => 'Hello from Firebase!',
                'body' => 'This is a test notification.'
            ],
            'topic' => 'global'
        ]);

        $messaging->send($message);

        return response()->json(['message' => 'Push notification sent successfully']);
    }
}
