<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoadmapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'media'=>MediaResource::make($this,'roadmaps'),
            'name'=>$this->name,
            'category'=>$this->category,
            'rate'=>$this->rate,
        ];
    }
}
