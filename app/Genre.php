<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function posts(){
       return $this->belongsToMany('App\Post');
    }

    public function profile(){
        return $this->belongsToMany('App\Profile');
     }
}
