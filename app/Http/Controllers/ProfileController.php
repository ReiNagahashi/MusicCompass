<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Sex;
use App\Host;
use App\Profile; 
use App\Genre;
use App\Follow;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Follow $follow){

        $follower_count = $follow->getFollowerCount(Auth::user()->id);


        return view('users.index')->with('user',Auth::user())
                                  ->with('profiles',Profile::first())
                                  ->with('sex',Sex::first())
                                  ->with('follower_count',$follower_count);
                                //   ->with('follow_count',$follow_count);
    }

    public function show(User $user, Follow $follow){

        $login_user = Auth::user()->id;
       
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        // $friend_count = $follow->getFriendCount($user->id);
        // $friend_count = Follow::Follower($user->id)->Follow($user->id);


        return view('users.show')->with('user',$user)
                                  ->with('login_user',$login_user)
                                  ->with('sex',Sex::first())
                                  ->with('users',User::all())
                                  ->with('follower_count',$follower_count)
                                  ->with('follow_count',$follow_count);

    }

    public function edit(User $user){

        return view('users.edit')->with('user',Auth::user())
                                 ->with('sexes',Sex::all())
                                 ->with('genres',Genre::all());
    }


    public function update(ProfileRequest $request,User $user){

        $user = Auth::user();

        if($request->hasFile('avatar')){

            $avatar = $request->avatar;
            $uploadImg = $avatar->avatar = $request->file('avatar');
            $path = Storage::disk('s3')->putFile('/',$uploadImg,'public');
            $user->profile->avatar = Storage::disk('s3')->url($path);
            $user->profile->save();

    }



        $user->profile->age=$request->age;
        $user->profile->native=$request->native;
        $user->profile->favorite=$request->favorite;
        $user->profile->sex_id=$request->sex_id;
        // $user->profile->host_id=$request->host_id;
        $user->profile->intro=$request->intro;


        $user->profile->save();
        $user->profile->genres()->sync($request->genres);



        Session::flash('success','プロフィールを編集しました！');
        return redirect('/profile');
    }

    public function setting(){

        return view('users.settings')->with('user',Auth::user());
    }

    public function updateForSetting(Request $request){
        $this->validate(request(),[
        'email'=>'email',
        'password'=>'required'
        ]);

        $user = Auth::user();

        $user->email=$request->email;
        $user->save();

        if($request->has('password')){
            $user->password = bcrypt($request->password);
            $user->save();
        }
        Session::flash('success','Account Profile update');
        return redirect('/profile');
    }

    public function create(){

            $sexes = Sex::all();
            // $hosts = Host::all();
            $genres = Genre::all();

            return view('users.edit')->with('sexes',$sexes)
                                    //  ->with('hosts',$hosts)
                                     ->with('genres',$genres);
    }
        
    

    public function store(ProfileRequest $request){

        // store data into database
        $profile = new Profile;
        
        // $profile->name = $request->name;
        $profile->age = $request->age;
        $profile->native = $request->native;
        $profile->favorite = $request->favorite;
        $profile->intro = $request->intro;
        $profile->sex_id =$request->sex_id;
        $profile->user_id = Auth::user()->id;

        $avatar = $request->avatar;
        $uploadImg = $avatar->avatar = $request->file('avatar');
        $path = Storage::disk('s3')->putFile('/',$uploadImg,'public');
        $profile->avatar = Storage::disk('s3')->url($path);

        $profile->save();
        $profile->genres()->attach($request->genres);

        Session::flash('success','プロフィールを作成しました！');

        return redirect('/profile');
    }

    }