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
            'name'=>$this->name,
            'step_id'=>$this->level_detail_id,

        ];
    }
    public function withQuestions(){
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'step_id'=>$this->level_detail_id,
            'questions'=> QuestionResource::collection($this->questions)

        ];
    }
}
