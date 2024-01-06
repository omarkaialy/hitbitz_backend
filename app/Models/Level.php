<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }
    public function levelDetails()
    {
        return $this->hasMany(LevelDetail::class);
    }
}
