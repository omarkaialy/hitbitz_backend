<?php

namespace App\Http\Resources;

use App\Enums\QuestionTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
        ];
        if ($this->type == QuestionTypeEnum::tfQuiz) {
            $data['correctAnswer'] = [$this->isTrue];
        } else {
            $data['answers'] = ChoicesResource::collection($this->choices);
        }

        if (isset($this->media)) {
            $data['media'] = MediaResource::make($this, 'questions',false);
        }

        return $data;
    }
}
