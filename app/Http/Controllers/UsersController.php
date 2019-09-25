<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Profile;
// use App\Attend;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class UsersController extends Controller{
    public function index(){
        $users = User::where('id','!=',auth::id())->get();

        // $profiles = Profile::where('user_id','like',User::id())->get();

        return view('users.follow')->with('users',$users);
    }

    public function ShowFollow(User $user){
        $users = User::all();

        // $profiles = Profile::where('user_id','like',User::id())->get();

        return view('users.showFollow')->with('users',$users)
                                       ->with('user',$user);
    }

    public function follow(User $user){
        if(!Auth::user()->isFollowing($user->id)){
        // Create a new follow instance for the authenticated user
            Auth::user()->follows()->create([
                'target_id' => $user->id,  
            ]);

            Session::flash('success',$user->name. 'さんをフォローしました。');
            return back();
        }else{
            return back();
        }
    }

    public function unfollow(User $user)
    {
        if (Auth::user()->isFollowing($user->id)) {
            $follow = Auth::user()->follows()->where('target_id', $user->id)->first();
            $follow->delete();
                
            Session::flash('success',$user->name. 'さんのフォローを解除しました。');
            return back();
        }else{
            return back();
        }
    }



    
}
