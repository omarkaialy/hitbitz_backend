<?php

namespace App\Http\Resources;

use App\Models\LevelDetail;
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
        $levels = $this->whenLoaded('levels'); // Assuming $this represents the model instance

        if ($levels instanceof \Illuminate\Database\Eloquent\Collection && $levels->isNotEmpty()) {
            $levelIds = $levels->pluck('id')->toArray();
            $totalDuration = LevelDetail::query()->whereIn('level_id', $levelIds)->sum('duration');
            $data['duration'] = (int)$totalDuration;
        }
        $data['levels'] = LevelResource::collection($this->whenLoaded('levels'));
        $data['category'] = CategoryResource::make($this->whenLoaded('category'));
        return $data;
    }


}
