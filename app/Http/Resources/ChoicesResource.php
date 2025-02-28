<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChoicesResource extends JsonResource
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

        ];
        if (isset($this->image)) {
            $data['image'] = MediaResource::make($this->image,'choices',false);
        }
        if (isset($this->order)) {
            $data['order'] = $this->order;
        }
        if (isset($this->correct)) {
            $data['correct'] = $this->correct;
        }
        return $data;
    }
}
