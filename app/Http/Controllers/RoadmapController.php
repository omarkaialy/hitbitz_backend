<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Middleware\CheckRole;
use App\Http\Requests\StoreRoadmapRequest;
use App\Http\Resources\RoadmapResource;
use App\Models\Category;
use App\Models\Roadmap;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RoadmapController extends Controller
{
    public function __construct(protected ImageService $imageService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = Category::find($request->categoryId);
        if (!is_null($category) && !$category) {
            return ApiResponse::error(421, 'This category isn\'t Exist');
        } else if (!is_null($category) && !is_null($category->parent_id)) {
            $roadmaps = QueryBuilder::for(Roadmap::query()->with(['media', 'category']))->allowedFilters(['name', 'category_id'])->defaultSort('-updated_at')->Paginate(request()->perPage);

        } else if (!is_null($category)) {
            $ids = [];
            $categories = $category->childrens;
            foreach ($categories as $e) {
                $ids[] = $e->id;

            }
            $roadmaps = QueryBuilder::for(Roadmap::query()->with(['media', 'category'])->whereIn('category_id', $ids,))->allowedFilters(['name', 'category_id'])->defaultSort('-updated_at')->Paginate(request()->perPage);

        } else {
            $roadmaps = QueryBuilder::for(Roadmap::query()->with(['media', 'category']))->allowedFilters(['name', 'category_id'])->defaultSort('-updated_at')->Paginate(request()->perPage);
        }


        return ApiResponse::success(RoadmapResource::collection($roadmaps->items()), 200, 'This Is All Roadmaps');
    }

    public function indexFavorites()
    {
        $favorites = auth()->user()->favoriteRoadmaps()->with(['media'])->get();
        return ApiResponse::success(RoadmapResource::collection($favorites), 200);
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
    public function store(StoreRoadmapRequest $request)
    {
        try {
            $roadmap = new Roadmap();
            $roadmap->name = $request->name;
            $roadmap->description = $request->description;
            $roadmap->rate = 0;
            $category = Category::findOrFail($request->categoryId);
            if ($category->childrens()->exists())
                return ApiResponse::error(400, 'Cannot Associate Roadmap To Parent Category');
            $roadmap->category()->associate($category->id);

            $roadmap->save();
            $this->imageService->storeImage($roadmap, $request->image, 'roadMaps');
            return ApiResponse::success(RoadmapResource::make($roadmap), 200, 'Roadmap Created Successfully');
        } catch (\Exception $e) {
            return ApiResponse::error(419, $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $roadmap = Roadmap::query()->where('id', $id)->with(['media', 'category'])->get();
        if ($roadmap->isEmpty())
            return ApiResponse::error(404, 'Not Found');
        return ApiResponse::success(RoadmapResource::make($roadmap->first()), 200);
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
