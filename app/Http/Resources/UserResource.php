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

        if ($this->roles && $request->routeIs(['api.user.login', 'api.user.register'])) {
            $data['role'] = $this->whenLoaded('roles')->first()->name;
        }
         return $data;
    }
}
