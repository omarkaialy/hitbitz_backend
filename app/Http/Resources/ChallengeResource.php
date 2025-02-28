<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChallengeResource extends JsonResource
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
            'host' => UserResource::make($this->hostUser),
            'guest' => UserResource::make($this->guestUser),

            'quiz' => QuizResource::make($this->quiz)->withQuestions()
            , 'is_winner' => $this->winner_user_id==null?null :$this->winner_user_id == Auth::user()->id
        ];
    }
}
