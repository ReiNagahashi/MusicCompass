<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function posts(){
        $this->hasMany('App\Post');
    }
}
