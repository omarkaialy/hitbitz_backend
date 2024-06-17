<?php

namespace App\Http\Controllers;

use App\Enums\CategoryTypeEnum;
use App\Helpers\ApiResponse;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
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
        $query = QueryBuilder::for(Category::query())
            ->with(['media'])
            ->whereNull('parent_id')
            ->allowedFilters(['name', AllowedFilter::exact('type')])
            ->defaultSort('-created_at');

        // Step 1: Check if the user exists and has the required role
        if (Auth::user() && Auth::user()->hasRole('user')) {
            $user = Auth::user();

            // Step 2: Fetch categories with type = 2
            $categoriesWithType2 = $query->clone()
                ->where('type', CategoryTypeEnum::prof)
                ->get(); // Get all matching records

            // Step 3: Fetch associated user-specific category for user with type = 1
            $userCategory = null;
            if ($user->category && $user->category->type == CategoryTypeEnum::learn) {
                $userCategory = QueryBuilder::for(Category::query())
                    ->with(['media'])
                    ->where('id', $user->category->id)
                    ->allowedFilters(['name', AllowedFilter::exact('type')])
                    ->where('type', CategoryTypeEnum::learn) // Filter by type 2
                    ->whereNull('parent_id') // Filtering categories without a parent
                    ->get(); // Get all matching records
            }

            // Step 4: Merge results if user-specific category exists
            if ($userCategory && $userCategory->isNotEmpty()) {
                $categoriesWithType2 = $categoriesWithType2->merge($userCategory);
            }

            // Step 5: Return response with merged categories
            return ApiResponse::success(CategoryResource::collection($categoriesWithType2), 200, 'This Is Categories');
        }

        // Step 6: Fetch categories without filters and return response
        $categories = $query->where('type',CategoryTypeEnum::prof)->paginate(request()->perPage);
        return ApiResponse::success(CategoryResource::collection($categories->items()), 200, 'This Is Categories');
}

    public function indexSubs()
    {
        $categories = QueryBuilder::for(Category::query()->with(['media'])
            ->whereNotNull('parent_id'))
            ->allowedFilters(
                [
                    'name',
                    AllowedFilter::exact('parent_id'),
                ]
            )->defaultSort('-created_at')
            ->Paginate(request()->perPage);

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
    public function store(CategoryStoreRequest $request)
    {
        try {


            $category = new Category();
            $category->name = $request->name;
            if (isset($request->parentId)) {
                $parent = Category::findOrFail($request->parentId);
                if ($parent->parent_id !== null) {
                    return ApiResponse::error(419, 'Cannot Associate To A SubCategory');
                }
                $category->parent()->associate($request->parentId);
            }

            if (isset($request->type)) $category->type = CategoryTypeEnum::from($request->type);
            $category->save();
            $this->imageService->storeImage($category, $request->image, 'categories');
            return ApiResponse::success(CategoryResource::make($category), 200, 'Category Created Successfully');
        } catch (\Throwable $e) {
            return ApiResponse::error(419, $e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $category)
    {
        $catego = Category::query()->where('id', $category)->with(['media', 'childrens'])->get()->first();

        return ApiResponse::success(CategoryResource::make($catego)->withChildrens(), 200);

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
