<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    public function hostUser()
    {
        return $this->belongsTo(User::class, 'host_user_id');
    }

    public function guestUser()
    {
        return $this->belongsTo(User::class, 'guest_user_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
