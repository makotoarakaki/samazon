<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Kyslik\ColumnSortable\Sortable;

class Event extends Model
{
    use Favoriteable, Sortable;

    public $sortable = [
       'updated_at'
    ];

    public function tickets()
    {
        return $this->belongsTo('App\Ticket', 'id', 'event_id');
    }
}
