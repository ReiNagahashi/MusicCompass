<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id','age','sex_id','host_id','profile_id','avatar_image','interest','favorite','native','intro'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function sex(){
        return $this->belongsTo('App\Sex');
    }
    public function host(){
        return $this->belongsTo('App\Host');
    }

    public function comment_for_users(){
        return $this->hasMany('App\CommentForUser');
    }

    public function genres(){
        return $this->belongsToMany('App\Genre');
    }

}