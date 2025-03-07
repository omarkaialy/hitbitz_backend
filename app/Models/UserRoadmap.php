<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoadmap extends Model
{
    use HasFactory;
    protected $table = 'user_roadmap';

    public function roadmap(){
        return $this->belongsTo(Roadmap::class,'roadmap_id');
    }
}
