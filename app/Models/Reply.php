<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    public function quetion()
    {
        return $this->belongsTo('App\Models\Quetion');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function like()
    {
        return $this->hasMany('App\Models\Like');
    }


}
