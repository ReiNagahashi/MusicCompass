<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    public function posts(){
        $this->hasMany('App\Post');
    }
}
