<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class follow extends Model
{
    protected $fillable = ['target_id','user_id'];

    public function user(){ 
        return $this->belongsTo('App\User');
    }

    public function getFollowerCount($target_id)
    {
        return $this->where('target_id', $target_id)->count();
    }

    public function getFollowCount($user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    public function getFriendCount($target_id,$user_id)
    {
        return $this->where('target_id', $target_id)->where('user_id', $user_id)->count();
    }

    // public function scopeFollower($target_id){
    //     return $this->where('target_id', $target_id)->count();
    // }
    // public function scopeFollow($user_id)
    // {
    //     return $this->where('user_id', $user_id)->count();
    // }
}
