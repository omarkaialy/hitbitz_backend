<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\RoadmapResource;
use App\Models\Roadmap;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RoadmapController extends Controller
{
    public function __construct(protected ImageService $imageService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $roadmaps = QueryBuilder::for(Roadmap::query()->with(['media']))->allowedFilters(['name', 'subcategory_id'])->defaultSort('-updated_at')->Paginate(request()->perPage);

        return ApiResponse::success(RoadmapResource::collection($roadmaps->items()), 200, 'This Is All Roadmaps');
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
        $request->validate(['name' => 'required|min:4', 'image' => 'required', 'subcategoryId' => 'required', 'description' => 'required|min:10']);
        $roadmap = new Roadmap();
        $roadmap->name = $request->name;
        $roadmap->description = $request->description;
        $roadmap->subcategory()->associate($request->subcategoryId);
        $roadmap->rate = 0;

        $roadmap->save();
        $this->imageService->storeImage($roadmap, $request->image, 'roadMaps');
        return ApiResponse::success($roadmap, 200, 'Roadmap Created Successfully');
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
    public function destroy(Roadmap $roadmap)
    {

        $roadmap->delete();
        return ApiResponse::success(null, 200, 'deleted');

        //
    }
}
