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

        // $keyword = $request->get('keyword');
            
    
        //     //もしキーワードが入力されている場合 
        //     if(!empty($keyword))
        //     {   
        //         //名前から検索
        //         $keyPres = Prefecture::where('name', 'like', '%'.$keyword.'%')->get();

        //         $keyPosts = Post::where('title', 'like', '%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->orWhere('name','like',$keyword)->get();

        //         $results = array_merge($keyPres->toArray(),$keyPosts->toArray());
        //         $results = new Paginator($results,10);

        //         $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);
                // ここまで

        $keyword = $request->input('keyword');
            
    
            //もしキーワードが入力されている場合 
            if(!empty($keyword))
            {   
                //名前から検索
                $keyPosts = Post::where('title', 'like', '%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->Paginate(3);

                // $keyPres = Prefecture::where('name', 'like', '%'.$keyword.'%')->Paginate(3);


                $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);

        //                 ->paginate(4);
    
                // //リレーション関係にあるテーブルの材料名から検索
                // $recipes = Recipe::whereHas('ingredients', function ($query) use ($keyword){
                //     $query->where('ingredient', 'like','%'.$keyword.'%');
                // })->paginate(4);
                Session::flash('result',count($keyPosts).'件の検索結果');
                return view('home')->with('posts',Post::orderBy('created_at','desc')->Paginate(3))   
                                    ->with('keyPosts',$keyPosts)
                                    ->with('keyword',$keyword)
                                    ->with('prefectures',Prefecture::all())
                                    ->with('genres',Genre::all())
                                    ->with('users',User::all())
                                    ->with('myposts',$myposts);
    
            }

         $myposts = Post::where('user_id', Auth::id())->orderBy('created_at','desc')->Paginate(3);

        return view('home')->with('posts',Post::orderBy('created_at','desc')->Paginate(3))
                            ->with('prefectures',Prefecture::all())
                            ->with('genres',Genre::all())
                            ->with('users',User::all())
                            ->with('myposts',$myposts);


    }

    public function show(){
        return view('homepage.aboutus');
    }
}
