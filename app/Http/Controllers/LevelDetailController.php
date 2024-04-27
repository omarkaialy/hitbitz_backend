<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\LevelDetailsResource;
use App\Models\LevelDetail;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LevelDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levelDetails = QueryBuilder::for(LevelDetail::query()->with(['level']))->allowedFilters([ AllowedFilter::exact('level_id')])->defaultSort('created_at')->Paginate(request()->perPage);
        return ApiResponse::success(LevelDetailsResource::collection( $levelDetails->items()), 200);
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
        $request->validate(['name' => 'required|min:5', 'levelId' => 'required', 'description' => 'required']);

        $details = new LevelDetail();
        $details->description = $request->description;
        $details->name = $request->name;
        $details->level()->associate($request->levelId);
        $details->save();
        return ApiResponse::success($details, 200);

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
    public function destroy(LevelDetail $levelDetail)
    {

        $levelDetail->delete();
        return ApiResponse::success(null, 200, 'Deleted Successfully');
    }
}
