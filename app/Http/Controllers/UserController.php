<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\RoadmapResource;
use App\Http\Resources\UserResource;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function index()
    {
        $users = QueryBuilder::for(User::role('user')->whereNot('id', '=', Auth::user()->id)->withWhereHas('friends', function ($query) {
            $query->where('accepted', '=', 0);
        }))->paginate();
        return ApiResponse::success(UserResource::collection($users->items()), 200);
    }

    public function indexReferees()
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
            return ApiResponse::success(RoadmapResource::make($roadmap), 200);

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
    public function show(User $id)
    {
        if ($id->id != Auth::user()->id) {
            $user = User::query()->where('id', '=', $id->id)->withWhereHas('friends', function ($query) {
                return $query->where('accepted', '=', 1);
            })->get()->first();
            return ApiResponse::success(UserResource::make($user), 200);

        } else {
            $profile = User::query()->where('id', '=', $id->id)->with('friends')->get()->first();
return $profile;
            return ApiResponse::success(UserResource::make($profile), 200);


        }
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
