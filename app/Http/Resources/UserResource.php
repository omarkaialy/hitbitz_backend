<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $includeToken = false;

    public function includeToken($value = true)
    {
        $this->includeToken = $value;
        return $this;
    }


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'full_name' => $this->full_name,
            'birth_date' => $this->birth_date,
            'email' => $this->email,

        ];
        if (isset($this->referrer_id)) {
            $data['referrer'] = $this->referrer_id;
        }
        if ($this->includeToken) {
            $data['access_token'] = $this->token;
        }

        if ($this->includeToken) {
            $data['role'] = $this->whenLoaded('roles', function () {
                return $this->roles->first()->name;
            });
        }
        if($this->userRoadmap)
        $data['roadmaps']=RoadmapResource::collection($this->userRoadmap);

        $data['totalRoadmaps']=$this->userRoadmap->count();
        $data['totalFails']= $this->quizzes->sum('pivot.failed');
        $data['totalSuccess']= $this->quizzes->sum('pivot.success');
        $data['roadmapAdmin'] = RoadmapResource::make($this->whenLoaded('roadmapAdmin'));
        $data['categoryAdmin'] = CategoryResource::make($this->whenLoaded('categoryAdmin'));
        $data['category'] = CategoryResource::make($this->whenLoaded('category'));
        $data['profileImage'] = MediaResource::make($this, 'profile');
        return $data;
    }
}
