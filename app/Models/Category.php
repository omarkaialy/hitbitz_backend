<?php

namespace App\Models;


use App\Enums\CategoryTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        'type' => CategoryTypeEnum::class
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->whereNotNull('type');
    }

    public function childrenRecursive()
    {
        return $this->childrens()->with('childrenRecursive');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function roadmap()
    {
        return $this->hasMany(Roadmap::class);
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'category_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'category_id');
    }
}
