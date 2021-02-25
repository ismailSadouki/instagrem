<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'birth_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'from_user_id');
    }

    public function follower()
    {
        return $this->hasMany(Follower::class, 'to_user_id');
    }


    //check if User is online
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }
}
