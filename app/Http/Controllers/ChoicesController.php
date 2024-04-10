<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\ChoicesResource;
use App\Models\Choices;
use App\Models\Question;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ChoicesController extends Controller
{
    public function __construct(protected ImageService $imageService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request, Question $question)
    {
        $choice = new Choices();
        $choice->title = $request->title;
        $choice->question()->associate($question->id);
        $choice->correct = $request->
        $choice->save();
        if ($request->has('image')) {
            $this->imageService->storeImage($choice, $request->image, 'choices');
        }
        return ApiResponse::success(ChoicesResource::make($choice), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Choices $choices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Choices $choices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Choices $choices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Choices $choices)
    {
        //
    }
}
