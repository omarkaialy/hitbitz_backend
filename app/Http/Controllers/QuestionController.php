<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuestionController extends Controller
{
    public function __construct(protected ImageService $imageService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = QueryBuilder::for(Question::query()->with(['quiz', 'choices']))->allowedFilters([AllowedFilter::exact('quiz_id')])->defaultSort('-updated_at')->Paginate();
        return ApiResponse::success(QuestionResource::collection($questions->items()), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $question = new Question();
        $question->title = $request->title;
        $question->quiz()->associate($request->quizId);
        $question->type = $request->type;
        if (isset($request->isTrue)) {
            $question->isTrue = $request->isTrue;
        }

        $question->save();
        if (isset($request->image)) {
            $this->imageService->storeImage($question, $request->image, 'questions');
        }
        if (isset($request->answers)) {
            foreach ($request['answers'] as $answer) {

                $data = [
                    'title' => $answer['title'],
                ];
                if (isset($answer['isCorrect'])) {
                    $data['correct'] = $answer['isCorrect'];
                }
                if (isset($answer['order'])) {
                    $data['order'] = $answer['order'];
                }
                $choice = $question->choices()->create(
                    $data);
                if (isset($answer['image'])) {
                    $this->imageService->storeImage($choice, $answer['image'], 'choices');
                }
            }
        }
        return ApiResponse::success(QuestionResource::make($question), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
