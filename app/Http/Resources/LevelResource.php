<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
            'order' => $this->order,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'level_details' => $this->levelDetails->map(function ($levelDetails) {
                return LevelDetailsResource::make($levelDetails);
            })
        ];
    }


    public function withRoadmap()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'order' => $this->order,
            'description' => $this->description,
            'requirements' => $this->requirements,
        ];
        $data['roadmap'] = RoadmapResource::make($this->roadmap);
        $data['level_details'] = $this->levelDetails->map(function ($levelDetails) {
            return LevelDetailsResource::make($levelDetails);
        });
        return $data;
    }
}
