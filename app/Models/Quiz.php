<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public function levelDetail()
    {
        return $this->belongsTo(LevelDetail::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_quiz')
            ->withPivot(['completed','score','id'])
            ->withTimestamps();
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
