<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\RoadmapResource;
use App\Http\Resources\UserResource;
use App\Models\Roadmap;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    public function __construct(protected ImageService $imageService)
    {
        // Apply middleware to specific methods
        $this->middleware('auth')->only(['toggleFavorite', 'indexReferals']);
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {

            if (Auth::user()) {
                $users = QueryBuilder::for(User::role('user')->whereNot('id', '=', Auth::user()->id))->paginate();
                return ApiResponse::success(UserResource::collection($users->items()), 200);
            } else {
                return ApiResponse::error(400, 'UnAuthorized');
            }
        } catch (\Exception $e) {
            return ApiResponse::error(400, $e->getMessage());
        }
    }

    public function indexAdmins()
    {
        $users = QueryBuilder::for(User::role('admin')->with('categoryAdmin'))->paginate();
        return ApiResponse::success(UserResource::collection($users->items()), 200);
    }

    public function showAdmin(User $user)
    {
        $admin = QueryBuilder::for(User::role('admin')->with('categoryAdmin'))->where('id', $user->id)->first();
        return ApiResponse::success(UserResource::make($admin), 200);
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
            $user = User::query()->where('id', '=', $id->id)->get()->first();
            return ApiResponse::success(UserResource::make($user), 200);

        } else {
            $profile = User::query()->where('id', '=', $id->id)->get()->first();

            return ApiResponse::success(UserResource::make($profile), 200);


        }
    }

    public function showProfile(Request $request)
    {
        return ApiResponse::success(UserResource::make(User::query()
            ->where('id', Auth::user()->id)
            ->with(['quizzes', 'userRoadmap', 'referrer', 'referees'])
            ->get()->first()), 200);
    }

    public function createAdmin(Request $req)
    {
        try {
            $user = new User();
            $user->user_name = $req->userName;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->full_name = $req->fullName;
            if ($req->birthDate)
                $user->birth_date = $req->birthDate;
            if ($req->categoryId)
                $user->categoryAdmin()->associate($req->categoryId);
            $user->assignRole('admin');
            $user->save();

            return ApiResponse::success(UserResource::make($user), 200);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getCode(), $e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();
            if ($request->profileImage) {
                $this->imageService->updateMedia($user, $request->profileImage, 'profile');
            }
            if ($request->categoryId) {
                $user->category()->associate($request->categoryId);
            }
            if ($request->birthDate) {
                $user->birth_date = date($request->birthDate);

            }
            if ($request->fullName) {
                $user->full_name = $request->fullName;
            }
            $user->update();
            $user->load(['media', 'category']);
            return ApiResponse::success(UserResource::make($user), 200);
        } catch (\Exception $e) {
            return ApiResponse::error(400, $e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            if ($request->categoryId && Auth::user()->hasRole('super_admin')) {
                $user->categoryAdmin()->associate($request->categoryId);
            }
            if ($request->birthDate) {
                $user->birth_date = date($request->birthDate);

            }
            if ($request->fullName) {
                $user->full_name = $request->fullName;
            }
            if ($request->password) {
                $user->password = $request->password;
            }
            $user->update();
            $user->load(['media', 'categoryAdmin']);
            return ApiResponse::success(UserResource::make($user), 200);
        } catch (\Exception $e) {
            return ApiResponse::error(400, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getMyRoadmaps()
    {
        $user = Auth::user();
        $roadmaps = $user->userRoadmap;
        $roads = Roadmap::query()->with(['media', 'userRoadmap' => function ($query) {
            $query->where('user_id', Auth::user()->id);
        }])->whereIn('id', $roadmaps->pluck('id'))->get();
        return ApiResponse::success(RoadmapResource::collection($roads), 200);
    }

    public function getHomeRoadmap()
    {
        $user = Auth::user();
        $roadmaps = $user->userRoadmap;
        $roads = Roadmap::query()
            ->join('user_roadmap', function ($join) {
                $join->on('roadmaps.id', '=', 'user_roadmap.roadmap_id')
                    ->where('user_roadmap.user_id', '=', Auth::user()->id);
            })
            ->with(['media', 'userRoadmap' => function ($query) {
                $query->where('user_id', Auth::user()->id);
            }])
            ->whereIn('roadmaps.id', $roadmaps->pluck('id'))
            ->orderBy('user_roadmap.progress', 'desc') // Order by progress ascending
            ->get(['roadmaps.*'])->first();
        return ApiResponse::success(RoadmapResource::make($roads), 200);
    }

    public function destroy(string $id)
    {
        //
    }
}
