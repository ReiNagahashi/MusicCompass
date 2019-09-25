<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Sex;
use App\Profile; 
use App\Follow; 
use Illuminate\Support\Facades\Session;



class ProfileController extends Controller
{
    public function index(){

       
        // $follow_count = Auth::user()->isFollowing($user->id) && $user->isFollowing(Auth::User()->id)->count();

        // @if (Auth::User()->isFollowing($user->id) && $user->isFollowing(Auth::User()->id))


        return view('users.index')->with('user',Auth::user())
                                  ->with('profiles',Profile::first())
                                  ->with('sex',Sex::first());
                                //   ->with('follow_count',$follow_count);
    }
    
  

    public function show(User $user){

        return view('users.show')->with('user',$user)
                                //   ->with('profile',$profile)
                                  ->with('sex',Sex::first())
                                  ->with('users',User::all());

    }

    public function edit(User $user){

        return view('users.edit')->with('user',Auth::user())
                                 ->with('sexes',Sex::all());
    }


    public function update(Request $request,User $user){
        $this->validate(request(),[
        'age'=>'required',
        'sex_id'=>'required',
        'native'=>'required',
        'favorite'=>'required',
        'interest'=>'required',
        'intro'=>'required',
        'avatar'=>'required',
        ]);


        $user = Auth::user();

        if($request->hasFile('avatar')){

       
            $avatar = $request->file('avatar');
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatars/',$avatar_new_name);
            $user->profile->avatar = 'uploads/avatars/'.$avatar_new_name;
            $user->profile->save();
            
    }


        $user->profile->age=$request->age;
        $user->profile->native=$request->native;
        $user->profile->favorite=$request->favorite;
        $user->profile->interest=$request->interest;
        $user->profile->sex_id=$request->sex_id;
        $user->profile->intro=$request->intro;


        $user->profile->save();



        Session::flash('success','プロフィールを編集しました！');
        return redirect('/profile');
    }

    public function setting(){

        return view('users.settings')->with('user',Auth::user());
    }

    public function updateForSetting(Request $request){
        $this->validate(request(),[
        'email'=>'required|email',
        // 'password'=>'required|confirmed'
        ]);

        $user = Auth::user();

        $user->email=$request->email;
        $user->save();

        if($request->has('password')){
            $user->password = bcrypt($request->password);
            $user->save();
        }
        // Session::flash('success','Account Profile update');
        return redirect('/profile');
    }

    public function create(){

        $id = Profile::where('user_id',Auth::id());

        if('$id' < 1){
            $sexes = Sex::all();

            return view('users.edit')->with('sexes',$sexes);
        }else{
           
            return redirect('/profile');

        }
    }
        
    

    public function store(Request $request){

        $this->validate($request,[
            // ここはform内にあるname！！！ 
            'age'=>'required|min:1',
            'native'=>'required|min:1',
            'favorite'=>'required|min:1',
            'interest'=>'required|min:1',
            'intro'=>'required|min:1',
            'avatar'=>'required',
            'sex_id'=>'required',

            
        ]);

        // store data into database
        $profile = new Profile;
        
        // $profile->name = $request->name;
        $profile->age = $request->age;
        $profile->native = $request->native;
        $profile->favorite = $request->favorite;
        $profile->interest = $request->interest;
        $profile->intro = $request->intro;
        $profile->sex_id =$request->sex_id;
        $profile->user_id = Auth::user()->id;

        $avatar = $request->file('avatar');
        $avatar_new_name = time().$avatar->getClientOriginalName();
        $avatar->move('uploads/avatars',$avatar_new_name);
        $profile->avatar = 'uploads/avatars/'.$avatar_new_name;

        $profile->save();


        Session::flash('success','プロフィールを作成しました！');

        //redirect index page
        return redirect('/profile');
    }
    // 
}
