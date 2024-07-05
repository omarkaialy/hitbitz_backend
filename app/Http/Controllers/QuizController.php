<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuizResource;
use App\Http\Resources\RoadmapResource;
use App\Models\Level;
use App\Models\LevelDetail;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Roadmap;
use App\Rules\OneOf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuizController extends Controller
{

    public function index()
    {
        if (Auth::user()) {

            $quizes = QueryBuilder::for(Quiz::query()->with(['levelDetail', 'users' => function ($query) {
                $query->where('user_id', Auth::user()->id)->select('completed');
            }])
            )
                ->allowedFilters([AllowedFilter::exact('level_detail_id')])
                ->defaultSort('order')
                ->Paginate(request()->perPage);

        } else {
            $quizes = QueryBuilder::for(Quiz::query()->with(['levelDetail']))
                ->allowedFilters([AllowedFilter::exact('level_detail_id')])
                ->defaultSort('-created_at')
                ->Paginate(request()->perPage);
        }
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
            // Update user roadmap progress
            $user->userRoadmap()->sync([$roadmapId => ['progress' => $progress * 100]], false);
            // Check if user completed all quizzes in the current level
            $currentLevelSteps = Quiz::query()->with(['users'])->where('level_detail_id', $quiz->levelDetail->id)->get();

            $allQuizzesCompleted = true;
            foreach ($currentLevelSteps as $quiz) {
                $userPivot = $quiz->users->firstWhere('pivot.user_id', $user->id);

                if (!$userPivot || $userPivot->pivot->completed != 1) {
                    $allQuizzesCompleted = false;
                }
            }

            if ($allQuizzesCompleted) {
                // Get the next level
                $nextLevel = $userRoadmap->levels()
                    ->where('order', '=', $userRoadmap->pivot->current_level)
                    ->first();
                $nextLevel = $nextLevel->levelDetails->where('order', '>', $userRoadmap->pivot->current_step)->first();
                if ($nextLevel) {

                    $user->userRoadmap()->sync([$roadmapId => ['current_step' => $nextLevel->order]], false);
                    $nextLevel = 0;
                } else {
                    $nextLevel = $userRoadmap->levels()->where('order', '>', $userRoadmap->pivot->current_level)->orderBy('order')->first();
                }
                if ($nextLevel) {
                    $user->userRoadmap()->sync([$roadmapId => ['current_level' => $nextLevel->order]], false);
                    $user->userRoadmap()->sync([$roadmapId => ['current_step' => 1]], false);
                }
                $userRoadmap = $user->userRoadmap()
                    ->where('roadmap_id', $roadmapId)->first();

                if ($userRoadmap->pivot->progress == 100) {
                    $user->userRoadmap()->sync([$roadmapId => ['completed' => 1]], false);

                }
            }

            // Retrieve the updated response
            $response = Roadmap::query()->where('id', '=', $roadmapId)
                ->withWhereHas('userRoadmap', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })->get()->first();
            return ApiResponse::success(RoadmapResource::make($response), 200);
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

    public function createCustomQuiz(Request $request)
    {
        try {

            $request->validate([
                'levelId' => ['required_without_all:stepId,roadmapId', new OneOf($request, ['stepId', 'levelId', 'roadmapId'],)],
                'stepId' => ['required_without_all:roadmapId,levelId', new OneOf($request, ['stepId', 'levelId', 'roadmapId'],)],
                'roadmapId' => ['required_without_all:levelId,stepId', new OneOf($request, ['stepId', 'levelId', 'roadmapId'],)],
            ]);
            if ($request->roadmapId) {
                $levels = Level::query()->where('roadmap_id', $request->roadmapId)->get()->pluck('id');

                $steps = LevelDetail::query()->whereIn('level_id', $levels)->select('id')->get();
                $quizzes = QueryBuilder::for(Quiz::query()->whereIn('level_detail_id', $steps->pluck('id')))->paginate();
                $questions = Question::query()->with('choices')->whereIn('quiz_id', $quizzes->pluck('id'))->get();
                return ApiResponse::success(QuestionResource::collection($questions->random($request->num ?? 20),), 200);
            }
            if ($request->levelId) {
                $steps = LevelDetail::query()->where('level_id', $request->levelId)->select('id')->get();
                $quizzes = QueryBuilder::for(Quiz::query()->whereIn('level_detail_id', $steps->pluck('id')))->paginate();
                $questions = Question::query()->with('choices')->whereIn('quiz_id', $quizzes->pluck('id'))->get();

                return ApiResponse::success(QuestionResource::collection($questions->random($request->num ?? 15)), 200);
            }
            if ($request->stepId) {
                $quizzes = QueryBuilder::for(Quiz::query()->where('level_detail_id', $request->stepId))->paginate();
                $questions = Question::query()->with('choices')->whereIn('quiz_id', $quizzes->pluck('id'))->get();
                return ApiResponse::success(QuestionResource::collection($questions->random($request->num ?? 10)), 200);

            }


        } catch (\Exception $e) {
            return ApiResponse::error(419, $e->getMessage());
        }
    }


}
