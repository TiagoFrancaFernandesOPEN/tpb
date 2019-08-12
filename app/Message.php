<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    function contact()
        {
            return $this->belongsTo('App\Contact');
        }
}
