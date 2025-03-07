<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Roadmap extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function admin(){
        return $this->belongsTo(User::class,'id','roadmap_id');
    }
    public function cvs(){
        return $this->morphMany(cv::class,'categorize');
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->whereNotNull('parent_id');
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }



    public function userRoadmap()
    {
        return $this->hasMany(UserRoadmap::class, 'roadmap_id');
    }


}
