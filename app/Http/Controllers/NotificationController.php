<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\NotificationResource;
use App\Jobs\SendNotification;
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

        $notifications = QueryBuilder::for(Notification::query())->allowedFilters(['topic'])->get();
        return ApiResponse::success(NotificationResource::collection($notifications), 200);

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
        $notifi = new Notification();
        $notifi->title = $request->title;
        $notifi->body = $request->body;
        $notifi->topic = 'all';
        $notifi->save();
        SendNotification::dispatch($request->title, $request->body, 'all',"http://localhost:8000/media/3/1717416330_363844946.png");
        return ApiResponse::success(NotificationResource::make($notifi), 200);
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
