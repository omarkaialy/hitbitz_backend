<?php

namespace App\Http\Resources;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CvResource extends JsonResource
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
            'username'=>$this->username,
            'fullName'=>$this->full_name,
            'email'=>$this->email,
            'cv'=>MediaResource::make($this,'cvs',) ,
            'categorize'=> $this->categorize_type == Roadmap::class? RoadmapResource::make($this->categorize) :CategoryResource::make($this->categorize)  ,

        ];
    }
}
