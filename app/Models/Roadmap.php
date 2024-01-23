<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;



    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
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
