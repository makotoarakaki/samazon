<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Ticket extends Model
{

    public function events()
    {
        return $this->belongsTo(Author::class);
//        return $this->hasMany('App\Event');
    }
}
