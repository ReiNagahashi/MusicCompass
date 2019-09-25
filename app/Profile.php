<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id','age','sex_id','avatar_image','interest','favorite','native','intro'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function sex(){
        return $this->belongsTo('App\Sex');
    }


}
