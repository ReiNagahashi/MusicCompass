<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentForUser extends Model
{
    protected $fillable = ['user_id','profile_id','body'];


    public function profile(){
        return $this->belongsTo('App\Profile');
    }
}
