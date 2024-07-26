<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();

        // Hook into the creating event to set the order automatically
        static::creating(function ($levelDetail) {
            if ($levelDetail->order === null) {
                $maxOrder = Quiz::where('level_detail_id', $levelDetail->level_detail_id)->max('order');
                $levelDetail->order = $maxOrder !== null ? $maxOrder + 1 : 1;
            }
        });
    }
    public function levelDetail()
    {
        return $this->belongsTo(LevelDetail::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_quiz')
            ->withPivot(['completed','score','id','success','failed'])
            ->withTimestamps();
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
