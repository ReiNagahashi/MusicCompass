<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    protected $fillable = [
        'sex'
    ];

    public function profile(){
        return $this->hasMany('App\Profile');
    }
}
