<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function marks()
    {
        return $this->hasMany('App\Models\Mark');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function browses()
    {
        return $this->hasMany('App\Models\Browse');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
