<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 
    ];
    // 'provider', 'provider_id',

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function posts(){
        return $this->belongsToMany('App\Post');
    }

    // public function posts(){
    //     return $this->belongsToMany('App\Post');
    // }

    // public function followers(){
    //     return $this->belongsToMany(self::class,'followers','follows_id','user_id')
    //                 ->withTimestamps();
    // }

    public function follows(){
        return $this->hasMany('App\Follow');
    }

    public function isFollowing($target_id){
        return (boolean) $this->follows()->where('target_id',$target_id)->first(['id']);
    }

    // public function getFollowerCount($user_id)
    // {
    //     return $this->where('target_id', $user_id)->count();
    // }


    public function isAttending($target_id){
        return (boolean) $this->attends()->where('target_id',$target_id)->first(['id']);
    }

    public function attends(){
        return $this->hasMany('App\Attend');
    }

 

    // ヘルパー関数
    // public function follow($userid){
    //     $this->follows()->attach($userid);
    //     return $this;
    // }

    // public function unfollow($userid){
    //     $this->follows()->detach($userid);
    //     return $this;
    // }


}
