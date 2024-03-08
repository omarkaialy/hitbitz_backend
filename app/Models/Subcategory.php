<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Subcategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function roadmap()
    {
        return $this->hasMany(Roadmap::class);
    }
}
