<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
