<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\RoadmapResource;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        // Apply middleware to specific methods
        $this->middleware('auth')->only(['toggleFavorite', 'indexReferals']);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexReferals()
    {
        return ApiResponse::success(['numOfReferees' => count(Auth::user()->referees)], 200);
    }

    public function toggleFavorite(Roadmap $roadmap)
    {


        $user = Auth::user();
        if ($user->userRoadmap()->where('roadmap_id', $roadmap->id)->exists()) {
            // If the user has already favorited the roadmap, update the pivot table
            if ($user->userRoadmap()->where('roadmap_id', $roadmap->id)->get()->first()->pivot->favored == 1) {
                $user->userRoadmap()->updateExistingPivot($roadmap->id, ['favored' => false]);
            } else {
                $user->userRoadmap()->updateExistingPivot($roadmap->id, ['favored' => true]);
            }
        } else {
            // If the user hasn't favorited the roadmap yet, add it to the pivot table
            $user->userRoadmap()->attach($roadmap->id, ['favored' => true]);
        }
        return ApiResponse::success(null, 200, 'Favorite Status Changed');
    }

    public function rateRoadmap(Roadmap $roadmap)
    {
        $user = Auth::user();
        if ($user->userRoadmap()->where('roadmap_id', '=', $roadmap->id)->exists()
            && $user->userRoadmap()->where('roadmap_id', '=', $roadmap->id)->get()->first()->pivot->rate == 0) {
            $user->userRoadmap()->updateExistingPivot($roadmap->id, ['rate' => \request()->rate]);
            $roadmap->rate = $roadmap->userRoadmap()->average('rate');
            $roadmap->save();
            return ApiResponse::success(null, 200, 'Rated Successfully');
        } else {
            return ApiResponse::error(400, 'You Can\'t Rate This Roadmap');
        }
    }

    public function startRoadmap(Roadmap $roadmap)
    {
        $user = Auth::user();
        if ($user->userRoadmap()->where('roadmap_id', '=', $roadmap->id)->exists()) {
            return ApiResponse::error(400, 'You Already Started This Roadmap');
        } else {
            $user->userRoadmap()->attach($roadmap, ['completed' => 0]);
            $roadmap = Roadmap::query()->where('id', $roadmap->id)->with(['media', 'category', 'levels'])
                ->withWhereHas('userRoadmap', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get()->first();
            return ApiResponse::success(RoadmapResource::make( $roadmap), 200);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
