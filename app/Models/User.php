<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use  HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard_name = 'api';


    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'user_quiz')
            ->withPivot('completed')
            ->withTimestamps();
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('accepted', true);
    }

    public function roadmap()
    {
        return $this->hasMany(Roadmap::class);
    }

    public function favorites()
    {
        return $this->hasMany(UserRoadmap::class, 'user_id');
    }

    public function favoriteRoadmaps()
    {
        return $this->belongsToMany(Roadmap::class, 'user_roadmap', 'user_id', 'roadmap_id')->withTimestamps();
    }
}
