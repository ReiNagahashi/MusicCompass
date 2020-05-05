<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\User;
use App\Attend;
use App\Prefecture;
use App\Location;
use App\Comment;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;

class PostsController extends Controller{

    public function show(Post $post)
    {
        $user_id = Auth::user()->id;
       
        $users = User::where('id','!=',auth::id())->get();

        $profile = Profile::where('user_id','=',Auth::user()->id)->first();
    
        // $post = Post::find($id);
        return view('posts.show')->with('post',$post)
                                 ->with('user_id',$user_id)
                                 ->with('users',$users)
                                 ->with('genres',Genre::all())
                                 ->with('profile',$profile);
                                //  ->with('time',Comment::orderBy('created_at','desc')->first());
        
    }

    public function create()
    { 
        $prefectures = Prefecture::all();
        $locations = Location::all();
        $genres = Genre::all();

        return view('posts.create')->with('prefectures',$prefectures)
                                   ->with('locations',$locations)
                                   ->with('genres',$genres);
    }

    public function store(PostRequest $request)
    {
    
            //store data into database
    
            $post = new Post;
            //ここの最後のtitleはcreate内のフォーム内にあるnameと一致させる　ちなみに、1つ目のtitleはテーブルめいなので注意
            $post->title = $request->title;
            $post->description = $request->description;
            $post->condition = $request->condition;
            $post->locationName = $request->location;
            $post->address = $request->address;
            $post->prefecture_id =$request->prefecture_id;
            $post->location_id =$request->location_id;
            $post->user_id = Auth::user()->id;
    

            $image = $request->image;
            $uploadImg = $image->image = $request->file('image');
            $path = Storage::disk('s3')->putFile('/',$uploadImg,'public');
            $post->post_image = Storage::disk('s3')->url($path);
    
    
            $post->save();
            $post->genres()->attach($request->genres);
    
    
            Session::flash('success','投稿に成功しました！');
    
            //redirect index page
            return redirect('home');
    }

    public function edit(Post $post) 
    {
        return view('posts.create')->with('post',$post)
                                   ->with('prefectures',Prefecture::all())
                                   ->with('locations',Location::all())
                                   ->with('genres',Genre::all());

    }

    public function update(PostRequest $request, Post $post)
    {
                
                //ここの最後のtitleはcreate内のフォーム内にあるnameと一致させる　ちなみに、1つ目のtitleはテーブルめいなので注意
                $post->title = $request->title;
                // $post->slug = str_slug($request->title);
                $post->description = $request->description;
                $post->condition = $request->condition;
                $post->locationName = $request->location;
                $post->address = $request->address;
                $post->user_id = Auth::user()->id;

                if($request->hasFile('image')){
                $image = $request->image;
                $uploadImg = $image->image = $request->file('image');
                $path = Storage::disk('s3')->putFile('/',$uploadImg,'public');
                $post->post_image = Storage::disk('s3')->url($path);
                }
            
                $post->save();
                $post->genres()->sync($request->genres);
                Session::flash('success','Post edit Successfully');

        
                //redirect index page
                return redirect(route('posts.show',['post' => $post->id]));


    }

 
    public function destroy(Post $post){
        $post->delete();
        Session::flash('success','削除に成功しました。');

        return redirect('home');
    }


        public function search(Request $request){

            $keyword = $request->input('keyword');
            
    
            //もしキーワードが入力されている場合 
            if(!empty($keyword))
            {   
                //名前から検索
                $keyPosts = Post::where('title', 'like', '%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->Paginate(3);
    
                Session::flash('result',count($keyPosts).'件の検索結果');
                return view('home')->with('keyPosts',$keyPosts)
                                     ->with('keyword',$keyword)
                                     ->with('prefectures',Prefecture::all())
                                     ->with('genres',Genre::all())
                                     ->with('users',User::all());
    
            }
            Session::flash('result','結果が見つかりませんでした');
    
                $keyPosts = Post::all()->get();
                return view('home')->with('keyPosts',$keyPosts)
                                     ->with('keyword',$keyword);
    
            }

        public function single(Post $post){

            $users = User::all();
            $user_id = Auth::user()->id;

            return view('posts.single')->with('users',$users)
                                       ->with('post',$post)
                                       ->with('user_id',$user_id);
        }

        public function attend(Post $post)
    {
        if(!Auth::user()->isAttending($post->id)){
            // Create a new follow instance for the authenticated user
                Auth::user()->attends()->create([
                    'target_id' => $post->id,  
                ]);
       
                Session::flash('success','「'.$post->title.'」　に参加しました！');
        
                //redirect index page
                return redirect(route('attendees.single',['post' => $post->id]));
        }
    }

    public function cancel(Post $post)
    {
        if (Auth::user()->isAttending($post->id)) {
            $attend = Auth::user()->attends()->where('target_id', $post->id)->first();
            $attend->delete();
                
            Session::flash('success','「'.$post->title.'」 への参加をキャンセルしました。');
            return redirect(route('posts.show',['post' => $post->id]));
        }
    }

    }