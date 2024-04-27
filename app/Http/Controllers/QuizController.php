<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuizController extends Controller
{

    public function index()
    {
        $quizes = QueryBuilder::for(Quiz::query()->with(['levelDetail']))->allowedFilters([AllowedFilter::exact('level_detail_id')])->defaultSort('-created_at')->Paginate(request()->perPage);
        return ApiResponse::success(QuizResource::collection($quizes->items()), 200);

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
        return ApiResponse::success(QuizResource::make($quiz)->withQuestions(), 200);
    }

    public function complete(Quiz $quiz)
    {
        try {
            // Validate the request data
            request()->validate([
                'score' => 'required|integer|min:0|max:100',
            ]);

            $user = Auth::user();
            $quizUser = $quiz->users()->where('user_id', $user->id)->first();

            // Check if the user has completed the quiz before
            if ($quizUser && $quizUser->pivot->completed == 1) {
                return ApiResponse::success(QuizResource::make($quizUser)->withUserPivot(), 200, 'You Completed This Quiz Before');
            }

            // Attach or update the pivot record
            $score = request()->score;
            $completed = $score >= 60 ? 1 : 0;

            if ($quizUser) {
                $quiz->users()->updateExistingPivot($user->id, compact('score', 'completed'));
            } else {
                $quiz->users()->attach($user->id, compact('score', 'completed'));
            }

            // Retrieve the updated response
            $response = QuizResource::make( $quiz->users()->where('user_id', $user->id)->with('quizzes')->first())->withUserPivot();

            return ApiResponse::success($response, 200);
        } catch (\Throwable $exception) {
            return ApiResponse::error(419, $exception->getMessage(), [$exception->getMessage()]);
        }

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
