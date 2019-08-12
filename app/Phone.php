<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    function contact()
        {
            return $this->belongsTo('App\Contact');
        }
}
