<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;
    public function roadmappable()
    {
        return $this->morphTo();
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
