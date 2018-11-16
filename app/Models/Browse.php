<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Browse extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }
}
