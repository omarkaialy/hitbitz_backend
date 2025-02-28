<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDetail extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        // Hook into the creating event to set the order automatically
        static::creating(function ($levelDetail) {
            if ($levelDetail->order === null) {
                $maxOrder = LevelDetail::where('level_id', $levelDetail->level_id)->max('order');
                $levelDetail->order = $maxOrder !== null ? $maxOrder + 1 : 1;
            }
        });
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
