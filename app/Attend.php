<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    protected $fillable = ['target_id'];

    public function post(){ 
        return $this->belongsTo('App\Post');
    }
}
