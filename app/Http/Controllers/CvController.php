<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\CvResource;
use App\Models\Category;
use App\Models\cv;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class CvController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cvs = QueryBuilder::for(cv::query()->with(['media', 'categorize']))->defaultSort('-created_at')->allowedFilters('categorize')->get();

        return ApiResponse::success(CvResource::collection($cvs), 200);
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
        $cv = new cv();
        $cv->username = $request->userName;
        $cv->full_name = $request->fullName;
        $cv->email = $request->email;
        if ($request->roadmapId) {
            $roadmap = Roadmap::find($request->roadmapId);
            $cv->categorize()->associate($roadmap);
        }
        if ($request->categoryId) {
            $category = Category::find($request->categoryId);
            $cv->categorize()->associate($category);
        }
        $cv->save();
        if ($request->hasFile('file')) {
            $mediaModel = $cv->addMediaFromRequest('file')->toMediaCollection('cvs');
            $mediaModel->save();
        }

        return ApiResponse::success(CvResource::make($cv), 200);
    }

    /**
     * Display the specified resource.
     */
    public function reject(cv $cv){
        $cv->update(['status'=>2]);
        return ApiResponse::success(CvResource::make($cv),200);
    }
    public function accept(cv $cv)
    {
        $cv->update(['status' => 1]);
        $user = new User();
        $user->user_name = $cv->username;
        $user->full_name = $cv->full_name;
        $user->email = $cv->email;
        $user->password = Hash::make('12345678');

        if ($cv->categorize instanceof Category ) {
            $user->assignRole('admin');
            $user->categoryAdmin()->associate($cv->categorize->id);
            $user->save();
        }
        if ($cv->categorize instanceof  Roadmap) {
            $user->assignRole('roadmap_admin');
            $user->roadmapAdmin()->associate($cv->categorize->id);
            $user->save();
        }
        return ApiResponse::success('accepted', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cv $cv)
    {
        //
    }

    public function show(cv $cv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cv $cv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cv $cv)
    {
        //
    }
}
