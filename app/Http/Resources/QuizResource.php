<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'step_id' => $this->level_detail_id,
            'order' => $this->order,
            'required_degree' => $this->required_degree,


        ];
    }

    public function withQuestions()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'step_id' => $this->level_detail_id,
            'order' => $this->order, 'description' => $this->description,

            'required_degree' => $this->required_degree,
            'questions' => QuestionResource::collection($this->questions)

        ];
    }

    public function withUserPivot()
    {
        return [
            'id' => $this->pivot->id,
            'completed' => $this->pivot->completed,
            'score' => $this->pivot->score,
        ];
    }
}
