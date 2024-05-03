<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelDetailsResource extends JsonResource
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
            'description' => $this->descirption,
            'order'=>$this->order,
            'duration'=>$this->duration

        ];
    }

    public function withLevel()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->descirption,
            'order'=>$this->order,
            'duration'=>$this->duration
        ];
        $data['level'] = LevelResource::make($this->level);
        return $data;
    }
}
