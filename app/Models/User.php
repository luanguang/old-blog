<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'province', 'city', 'district', 'address', 'self_introduction', 'fans', 'integrals', 'last_time', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function marks()
    {
        return $this->hasMany('App\Models\Mark');
    }

    public function browses()
    {
        return $this->hasMany('App\Models\Browse');
    }

    public function follows()
    {
        return $this->hasMany('App\Models\Follow');
    }

    public function getAvatarAttribute($avatar)
    {
        return !empty($avatar) ? $avatar : 'default_avatar.gif';
    }
}
