<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
     public function roadmaps()
    {
        return $this->morphMany(Roadmap::class, 'roadmappable');
    }
}
