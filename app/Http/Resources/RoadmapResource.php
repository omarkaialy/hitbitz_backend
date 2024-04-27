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
        $data = [
            'id' => $this->id,
            'media' => MediaResource::make($this, 'roadMaps'),
            'name' => $this->name,
            'description' => $this->description,
            'rate' => $this->rate,
        ];
        return $data;
    }

    public function withPivots()
    {
        $data = [
            'id' => $this->id,
            'media' => MediaResource::make($this, 'roadMaps'),
            'name' => $this->name,
            'description' => $this->description,
            'rate' => $this->rate,
        ];
        if (isset($this->category)) {
            $data['category'] = CategoryResource::make($this->category);
        }
        if (isset($this->levels)) {
            $data['levels'] = LevelResource::collection($this->levels);
        }
        return $data;
    }


}
