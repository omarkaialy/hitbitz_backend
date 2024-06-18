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
        try {
            $notifi = new Notification();
            $notifi->title = $request->title;
            $notifi->body = $request->body;
            $notifi->topic = $request->topic ?? 'all';
            $notifi->image = $request->imageUrl;
            $request->topic;
            $notifi->save();
            SendNotification::dispatch($request->title, $request->body,$request->topic ?? 'all',$request->imageUrl ,  'topic');
            return ApiResponse::success(NotificationResource::make($notifi), 200);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getCode(), $e->getMessage());
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
