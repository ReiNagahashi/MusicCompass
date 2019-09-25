<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','location','address','description','condition','post_image','user_id'];

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

      public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment')->whereNull('parent_id');
    }
    public function prefecture(){
        return $this->belongsTo('App\Prefecture');
    }
    public function location(){
        return $this->belongsTo('App\Location');
    }
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }

 



}
