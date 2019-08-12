<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   function phones()
    {
        return $this->hasMany('App\Phone');
        // return $this->belongsTo('App\Phone');
    }
   function messages()
    {
        return $this->hasMany('App\Message');
    }
}
