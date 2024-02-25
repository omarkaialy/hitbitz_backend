<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

       $roadmaps= Roadmap::all();
       return ApiResponse::success($roadmaps,200,'This Is All Roadmaps');
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
        $request->validate(['name'=>'required|min:4', 'subcategoryId'=>'required','description'=>'required|min:25']);
 $roadmap = new Roadmap();
 $roadmap->name= $request->name;
 $roadmap->description= $request->description;
 $roadmap->subcategory()->associate($request->subcategoryId);
 $roadmap->rate= 0;

 $roadmap->save();

    return ApiResponse::success($roadmap ,200,'Roadmap Created Successfully');}

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
    public function destroy(string $id)
    {
        //
    }
}
