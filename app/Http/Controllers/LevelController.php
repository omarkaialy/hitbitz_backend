<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Level;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = QueryBuilder::for(Level::query()->with(['roadmap']))->allowedFilters([ AllowedFilter::exact('roadmap_id', 'roadmap_id')])->defaultSort('-updated_at')->Paginate(request()->perPage);
        return ApiResponse::success($levels->items(), 200, 'Here Is All Levels');
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

        $level = new Level();
        $level->name = $request->name;
        $level->roadmap()->associate($request->roadmapId);
        $level->save();
        return ApiResponse::success($level, 200, 'Created Successfully');
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
    public function destroy(Level $level)
    {
        $level->delete();
        return ApiResponse::success(null, 200, 'deleted');

        //
    }
}
