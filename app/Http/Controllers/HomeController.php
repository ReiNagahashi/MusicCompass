<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Attend;
use App\Prefecture;
use App\Location;
use App\Comment;
use App\Genre;
use App\GenrePost;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // { 
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $prefecture_id = $request->prefecture_id;
        $location_id = $request->location_id;
        
        $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);
        $prefectures = Prefecture::all();
        $locations = Location::all();
        $genres = Genre::all();
        $users = User::all();
        $posts = Post::orderBy('created_at','desc')->Paginate(3);
        $postImages = Post::inRandomOrder()->limit(3)->pluck('post_image');

        //もしキーワードが入力されている場 
        if ($keyword || $prefecture_id || $location_id) {
            if ($keyword) {
                $keyPosts = Post::where('title', 'like', '%'.$keyword.'%')
                            ->orWhere('description','like','%'.$keyword.'%')
                            ->Paginate(3);
            }

            return view('home', compact(['posts', 'prefectures', 'locations', 'genres', 
                                'users', 'prefecture_id', 'location_id', 'keyword', 
                                 'keyPosts', 'myposts'])); 
                                //  'recommends',  return の部分でもifのように条件分岐ができたらrecommendを入れましょう。
        }



        return view('home', compact(['posts', 'prefectures', 'locations', 'genres', 
                                     'users', 'myposts', 'postImages']));                     
                                    //  'recommends',
    }

    public function show(){
        return view('homepage.aboutus');
    }

    public function welcome() {
        $postImages = Post::inRandomOrder()->limit(3)->pluck('post_image');

        $postImage = Post::inRandomOrder()->limit(1)->pluck('post_image');


        // $post = Post::inRandomOrder()->first('post')

        return view('welcome')->with('postImages', $postImages)
                              ->with('postImage', $postImage);

    }



}