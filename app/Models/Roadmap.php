<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Roadmap extends Model implements  HasMedia
{
    use HasFactory, InteractsWithMedia;



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
