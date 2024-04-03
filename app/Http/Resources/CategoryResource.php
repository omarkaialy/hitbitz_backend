<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (isset($this->type->id))
            if ($this->type->id == 1) $type = 'تعليمي'; else $type = 'مهني';
        else $type = null;
        if (isset($this->parent->id))
            if ($this->parent->id == 1) $parnet = 'تعليمي'; else $parnet = 'مهني';
        else $parnet = null;
        if (is_null($type)) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => MediaResource::make($this, 'categories'),
                'parent_id' => $this::make($this->parent)
            ];
        } else {
            return ['id' => $this->id,
                'name' => $this->name,
                'type' => $type,
                'image' => MediaResource::make($this, 'categories'),
            ];
        }
    }
}
