<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function __construct(protected ImageService $imageService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = QueryBuilder::for(Category::query()->with(['media']))->allowedFilters('name')->defaultSort('-created_at')->Paginate(request()->perPage);

        return ApiResponse::success( CategoryResource::collection($categories->items()), 200, 'This Is Categories');
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
        $category = new Category();
        $category->name = $request->name;
        $category->type()->associate($request->typeId);
        $category->save();
        $this->imageService->storeImage($category, $request->image, 'categories');

        return ApiResponse::success($category, 200, 'Category Created Successfully');
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
    public function destroy(Category $category)
    {
        $category->delete();
        return ApiResponse::success(null, 200, 'deleted');

    }
}
