<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class cv extends Model implements HasMedia
{
    protected $fillable=['username','email','full_name' ,'status'];
    use HasFactory,InteractsWithMedia;
    public function categorize(){
        return $this->morphTo();
    }
}
