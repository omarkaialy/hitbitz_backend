<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\LevelResource;
use App\Models\Category;
use App\Models\Level;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $category = Category::find(Auth::user()->category_id);
            $ids = [];
            $categories = $category->childrens;
            foreach ($categories as $e) {
                $ids[] = $e->id;
            }
            $roadmaps = Roadmap::query()->with(['media'])->whereIn('category_id', $ids,);
            $ids = [];
            foreach ($roadmaps as $e) {
                $ids[] = $e->id;
            }

            $levels = QueryBuilder::for(Level::query()->with(['roadmap'])->whereIn('roadmap_id', $ids))
                ->allowedFilters([AllowedFilter::exact('roadmap_id', 'roadmap_id')])
                ->defaultSort('-updated_at')
                ->Paginate(request()->perPage);

        } else {
            $levels = QueryBuilder::for(Level::query()->with(['roadmap']))
                ->allowedFilters([AllowedFilter::exact('roadmap_id', 'roadmap_id')])
                ->defaultSort('-updated_at')
                ->Paginate(request()->perPage);
        }
        return ApiResponse::success(collect($levels->items())->map(function ($level) {
            return LevelResource::make($level)->withRoadmap();
        }), 200, 'Here Is All Levels');
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {

        $level = new Level();
        $level->name = $request->name;
        $level->roadmap()->associate($request->roadmapId);
        $level->save();
        return ApiResponse::success($level, 200, 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        $level = Level::query()
            ->where('id', '=', $id)
            ->with(['roadmap', 'levelDetails'])
            ->get()->first();
        return ApiResponse::success(LevelResource::make($level)->withRoadmap(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Level $level)
    {
        $level->delete();
        return ApiResponse::success(null, 200, 'deleted');

        //
    }
}
