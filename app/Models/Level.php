<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $casts = ['requirements'=> 'array'];
    public static function boot()
    {
        parent::boot();

        // Hook into the creating event to set the order automatically
        static::creating(function ($levelDetail) {
            if ($levelDetail->order === null) {
                $maxOrder = Level::where('roadmap_id', $levelDetail->roadmap_id)->max('order');
                $levelDetail->order = $maxOrder !== null ? $maxOrder + 1 : 1;
            }
        });
    }

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function levelDetails()
    {
        return $this->hasMany(LevelDetail::class);
    }
}
