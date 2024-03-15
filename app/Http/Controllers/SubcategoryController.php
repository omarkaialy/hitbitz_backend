<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\SubCategoryResource;
use App\Models\Subcategory;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SubcategoryController extends Controller
{public function __construct(protected ImageService $imageService)
{
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = QueryBuilder::for(Subcategory::with(['media']) )->defaultSort('-created_at') ->allowedFilters(['category_id'])->Paginate(request()->perPage);
 return ApiResponse::success(SubCategoryResource::collection( $subCategories->items()),200,'Here Is All SubCategories');
        //
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
        $request->validate(['name'=>'required','image'=>'required']);
        $subCategory=new Subcategory();
        $subCategory->name=$request->name;
        $subCategory->category()->associate($request->categoryId);
        $subCategory->save();
        $this->imageService->storeImage($subCategory,$request->image,'subCategories');
          return ApiResponse::success($subCategory,200,'Created Successfully');
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
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return ApiResponse::success(null,200,'deleted');

    }
}
