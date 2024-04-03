<?php

namespace App\Http\Controllers;

use App\Enums\CategoryTypeEnum;
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
        $categories = QueryBuilder::for(Category::query()->with(['media'])->whereNull('parent_id'))->allowedFilters('name')->defaultSort('-created_at')->Paginate(request()->perPage);

        return ApiResponse::success(CategoryResource::collection($categories->items()), 200, 'This Is Categories');
    }

    public function indexSubs()
    {
        $categories = QueryBuilder::for(Category::query()->with(['media'])->whereNotNull('parent_id'))->allowedFilters('name')->defaultSort('-created_at')->Paginate(request()->perPage);

        return ApiResponse::success(CategoryResource::collection($categories->items()), 200, 'This Is Categories');
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
        if (isset($request->type) && isset($request->parentId)) return ApiResponse::error(421, 'TypeId And Parent Id Are Both Setted');
        else if (!isset($request->type) && !isset($request->parentId)) return ApiResponse::error(421, 'TypeId And Parent Id Are Both Not Setted');

        $category = new Category();
        $category->name = $request->name;
        if (isset($request->parentId)) {
            $parent = Category::findOrFail($request->parentId);
            if ($parent->parent_id !== null) {
                return ApiResponse::error(400, 'Cannot Associate To A SubCategory');
            }
            $category->parent()->associate($request->parentId);
        }

        if (isset($request->type)) $category->type = CategoryTypeEnum::from($request->type);
        $category->save();
        $this->imageService->storeImage($category, $request->image, 'categories');
        return ApiResponse::success(CategoryResource::make($category), 200, 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category)
    {
        $catego = Category::query()->where('id', $category)->with(['media'])->get()->first();
        return ApiResponse::success(CategoryResource::show($catego), 200);

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
