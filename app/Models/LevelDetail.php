<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDetail extends Model
{
    use HasFactory;
    public function level()
    {
        return $this->belongsTo(Level::class);
    } public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
