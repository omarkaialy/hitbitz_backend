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
            'media'=>MediaResource::make($this,'roadMaps'),
            'name'=>$this->name,
            'description'=> $this->description,
            'category'=>CategoryResource::make($this->category),
            'rate'=>$this->rate,
        ];
    }
}
