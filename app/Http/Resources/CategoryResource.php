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
        if( $this->type->id==1) $type='تعليمي';else $type= 'مهني';
        return [
            'id'=> $this-> id,
            'name' => $this->name,
            'type'=>$type,
            'image'=> MediaResource::make($this,'categories')

    ];

    }
}
