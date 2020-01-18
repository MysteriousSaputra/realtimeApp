<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quetion extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->belongsTo('App\Models\Reply');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
