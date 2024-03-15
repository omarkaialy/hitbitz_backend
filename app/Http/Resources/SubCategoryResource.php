<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [  'id'=> $this-> id,
            'name' => $this->name,
            'parent_category'=>CategoryResource::make($this->category),
            'image'=> MediaResource::make($this,'subCategories')
        ];
    }
}
