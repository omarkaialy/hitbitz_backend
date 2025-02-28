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
        $type = $this->type ?? null;
        if (is_null($type)) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => MediaResource::make($this, 'categories'),
                'parent_id' => $this->parent->id,
            ];
        } else {
            $data=[
                'id' => $this->id,
                'name' => $this->name,
                'type' => $type->name ,
                'image' => MediaResource::make($this, 'categories'),
            ];

            return $data;
        }
    }
    public function withChildrens(){
        $type = $this->type ?? null;
        if (is_null($type)) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => MediaResource::make($this, 'categories'),
                'parent_id' => $this->parent->id,
            ];
        } else {
            $data = [
                'id' => $this->id,
                'name' => $this->name,
                'type' => $type->name,
                'image' => MediaResource::make($this, 'categories'),
            ];
            if (isset($this->childrens)) {
                $data['childrens'] =CategoryResource::collection( $this->childrens);
            }
            return $data;
        }
    }
}
