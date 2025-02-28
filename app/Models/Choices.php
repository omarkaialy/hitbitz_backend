<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Choices extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable =['title','correct','order'];
    public function question(){
        return $this->belongsTo(Question::class);
    }
}
