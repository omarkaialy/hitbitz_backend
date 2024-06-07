<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\QuizResource;
use App\Models\LevelDetail;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuizController extends Controller
{

    public function index()
    {
        $quizes = QueryBuilder::for(Quiz::query()->with(['levelDetail']))
            ->allowedFilters([AllowedFilter::exact('level_detail_id')])
            ->defaultSort('-created_at')
            ->Paginate(request()->perPage);
        return ApiResponse::success(QuizResource::collection($quizes->items()), 200);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:4', 'stepId' => 'required', 'description' => 'required', 'requiredDegree' => 'required|min:1|max:100']);
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->required_degree = $request->requiredDegree;
        $quiz->description = $request->description;
        $quiz->levelDetail()->associate($request->stepId);
        $quiz->order = LevelDetail::find($request->stepId)->quizzes()->get()->count();
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
            $validatedData = request()->validate([
                'score' => 'required|integer|min:0|max:100',
            ]);

            $user = Auth::user();
            $quizUser = $quiz->users()->where('user_id', $user->id)->first();

            // Check if the user has completed the quiz before
            if ($quizUser && $quizUser->pivot->completed == 1) {
                return ApiResponse::success(QuizResource::make($quizUser)->withUserPivot(), 200, 'You Completed This Quiz Before');
            }

            // Attach or update the pivot record
            $score = $validatedData['score'];
            $completed = $score >= $quiz->required_degree ? 1 : 0;

            if ($quizUser) {
                $quiz->users()->updateExistingPivot($user->id, compact('score', 'completed'));
            } else {
                $quiz->users()->attach($user->id, compact('score', 'completed'));
            }

            // Update user roadmap
            $roadmapId = $quiz->levelDetail->level->roadmap->id;
            $userRoadmap = $user->userRoadmap()
                ->where('roadmap_id', $roadmapId)->first();
            if (!$userRoadmap) {
                $user->userRoadmap()->attach($roadmapId, ['completed' => 0]);
                $userRoadmap = $user->userRoadmap()->where('roadmap_id', $roadmapId)->first();
            }

            // Calculate progress
            $steps = $userRoadmap ? $userRoadmap->levels->flatMap->levelDetails->pluck('id')->toArray() : [];
            $quizzes = Quiz::whereIn('level_detail_id', $steps)->get();
            $completedQuizzes = $quizzes->filter(function ($quizz) use ($user) {
                return $quizz->users()->where('user_id', $user->id)->exists();
            })->count();
            $progress = count($quizzes) > 0 ? $completedQuizzes / count($quizzes) : 0;
            $allQuizzesCompleted = $user->quizzes()->whereIn('level_detail_id', $userRoadmap->levels->flatMap->levelDetails->pluck('id'))->wherePivot('completed', 0)->doesntExist();

            $user->userRoadmap()->sync([$roadmapId => ['completed' => $allQuizzesCompleted ? 1 : 0]], false);

            // Update user roadmap progress
            $user->userRoadmap()->sync([$roadmapId => ['progress' => $progress * 100]], false);
            // Check if user completed all quizzes in the current level
            $currentLevelSteps = $user->quizzes()->where('level_detail_id', $quiz->levelDetail->id)->get();
            $allQuizzesCompleted = $currentLevelSteps->every(function ($quiz) {
                return $quiz->pivot->completed == 1;
            });

            if ($allQuizzesCompleted) {
                // Get the next level
                $nextLevel = $userRoadmap->levels()
                    ->where('order', '>', $userRoadmap->pivot->current_step)
                    ->first();
                if ($nextLevel) {
                    $user->userRoadmap()->sync([$roadmapId => ['current_step' => $nextLevel->order]], false);
                } else {
                    $nextLevel = $userRoadmap->levels()->where('order', '>', $userRoadmap->pivot->current_level)->orderBy('order')->first();
                }
                if ($nextLevel) {
                    $user->userRoadmap()->sync([$roadmapId => ['current_level' => $nextLevel->order]], false);
                } else {
                    $user->userRoadmap()->sync([$roadmapId => ['completed' => 1]], false);

                }
            }

            // Retrieve the updated response
            $response = $user->userRoadmap()->where('roadmap_id','=',$roadmapId)->get()->first();
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
