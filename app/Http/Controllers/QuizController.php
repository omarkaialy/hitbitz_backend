<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuizController extends Controller
{

    public function index()
    {
        $quizes = QueryBuilder::for(Quiz::query()->with(['levelDetail']))->allowedFilters([AllowedFilter::exact('level_detail_id')])->defaultSort('-created_at')->Paginate(request()->perPage);
        return ApiResponse::success(QuizResource::collection( $quizes->items()), 200);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:4', 'stepId' => 'required']);
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->levelDetail()->associate($request->stepId);
        $quiz->save();
        return ApiResponse::success($quiz, 200, 'Quiz Created Successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quiz =
            Quiz::with(['questions'])->findOrFail($id);
        return  ApiResponse::success(QuizResource::make($quiz)->withQuestions(),200) ;
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
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return ApiResponse::success(null, 200, 'Deleted Successfully');
        //
    }
}
