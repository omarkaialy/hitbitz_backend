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
            ->withPivot(['completed', 'score', 'id'])
            ->withTimestamps();
    }


    public function friendships()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('accepted');
    }


    public function userFriendships()
    {
        return $this->hasMany(Friendship::class, 'user_id', 'id');
    }

    public function friendFriendships()
    {
        return $this->hasMany(Friendship::class, 'friend_id', 'id');
    }

    public function friends()
    {
        return $this->hasManyThrough(User::class, Friendship::class, 'user_id', 'id', 'id', 'friend_id')
      ; // Filter by accepted status
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class)->withTimestamps();
    }

    public function userRoadmap()
    {
        return $this->
        belongsToMany(Roadmap::class, 'user_roadmap', 'user_id', 'roadmap_id')
            ->withTimestamps()->withPivot(['favored', 'completed', 'current_level', 'rate', 'progress', 'current_step']);
    }

    public function referees()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }

    // Define the inverse relationship where one user belongs to a referrer
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function category()
    {
        return $this->hasOne(User::class);
    }
}
