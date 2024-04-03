<?php

namespace App\Models;

use App\Enums\QuestionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Question extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $casts=[
        'type'=>QuestionTypeEnum::class
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function choices(){
        return $this->hasMany(Choices::class);
    }

}
