<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Notification;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $notifications = QueryBuilder::for(Notification::query())->get();
            return ApiResponse::success($notifications, 200);
        } catch (\Exception $exception) {
            return ApiResponse::error(419, 'Error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $notification = new PushNotificationController();
            $notification = $notification->sendPushNotification('Hello', 'Hello', 'all');
            if ($notification == true) {
                $notifi = new Notification();
                $notifi->title = $request->title;
                $notifi->body = $request->body;
                $notifi->save();
                return ApiResponse::success(null, 200, 'Sent');
            }
        } catch (\Exception $exception) {
            return ApiResponse::error(411, $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
