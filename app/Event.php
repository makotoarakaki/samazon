<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Kyslik\ColumnSortable\Sortable;
use App\Ticket;

class Event extends Model
{
    use Favoriteable, Sortable;

    public $sortable = [
       'updated_at'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
//        return $this->belongsTo('App\Ticket', 'id', 'event_id');
    }
}
