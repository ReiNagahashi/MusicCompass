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
            
    
            //もしキーワードが入力されている場合 
            if(!empty($keyword))
            {   
                // ヒント：ポストを作り出す(Post::のように)のは1度だけでいいかもしれない。
                // そのあとに、viewのペーぞでif文を使って更に絞ってあげるとできるかもしれない
                // ヒント２：スコープを使うのはどうだろう！？

                //名前から検索
                $keyPosts = Post::where('title', 'like', '%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->Paginate(3);

                $keyPres = Post::where('prefecture_id','like'.$prefecture_id)->Paginate(3);

                // $keyLoc = Post::where('location_id','like'.$location)->Paginate(3);

                $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);

                Session::flash('result',count($keyPosts).'件の検索結果');
                return view('home')->with('posts',Post::orderBy('created_at','desc')->Paginate(3))   
                                    ->with('keyPosts',$keyPosts)
                                    ->with('keyPres',$keyPres)
                                    // ->with('keyLoc',$keyLoc)
                                    ->with('keyword',$keyword)
                                    ->with('prefecture_id',$prefecture_id)
                                    ->with('location_id',$location_id)
                                    ->with('prefectures',Prefecture::all())
                                    ->with('locations',Location::all())
                                    ->with('genres',Genre::all())
                                    ->with('users',User::all())
                                    ->with('myposts',$myposts);
    
            }

            if(!isset($keyword) && isset($prefecture_id,$location_id)){


                $keyPres = Post::where('prefecture_id','like',$prefecture_id)->where('location_id','like',$location_id)->Paginate(3);

                $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);

                Session::flash('result',count($keyPres).'件の検索結果');
                return view('home')->with('posts',Post::orderBy('created_at','desc')->Paginate(3))   
                                    ->with('keyPres',$keyPres)
                                    ->with('prefecture_id',$prefecture_id)
                                    ->with('location_id',$location_id)
                                    ->with('prefectures',Prefecture::all())
                                    ->with('locations',Location::all())
                                    ->with('genres',Genre::all())
                                    ->with('users',User::all())
                                    ->with('myposts',$myposts);
            }
            

         $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);

        return view('home')->with('posts',Post::orderBy('created_at','desc')->Paginate(3))
                            ->with('prefectures',Prefecture::all())
                            ->with('locations',Location::all())
                            ->with('genres',Genre::all())
                            ->with('users',User::all())
                            ->with('myposts',$myposts);


    }

    public function show(){
        return view('homepage.aboutus');
    }
}
