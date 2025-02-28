<?php

namespace App\Jobs;

use App\Http\Controllers\PushNotificationController;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $body;
    protected $topicOrToken;
    protected $imageUrl;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $body, $topicOrToken, $imageUrl = null,$type)
    {

        $this->title = $title;
        $this->body = $body;
        $this->topicOrToken = $topicOrToken;
        $this->imageUrl = $imageUrl;
        $this->type= $type;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifi = new Notification();
        $notifi->title = $this->title;
        $notifi->body = $this->body;
        $notifi->topic = $this->topic ?? 'all';
        $notifi->image = $this->imageUrl;
        $notifi->save();

        $controller = new PushNotificationController();
     return    $controller->sendPushNotification($this->title, $this->body, $this->topicOrToken,$this->imageUrl,$this->type);

    }
}
