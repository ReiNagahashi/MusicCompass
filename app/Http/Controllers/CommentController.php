<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\CommentForUser;
// use Carbon\Carbon;


class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'body'=>'required',
        ]);

        $input = $request->all();
        // $input['user_id'] = Auth::user()->id;
        $input['user_id'] = auth()->user()->id;
        // $time = Carbon::now();

        if(isset($input['profile_id'])){
            CommentForUser::create($input);

            return back()->with('time',CommentForUser::orderBy('created_at','desc')->first());
        }else{

        Comment::create($input);
         // return redirect(route('posts.show',['post' => $post->id]));
        // return redirect(route('posts.show'))->with('time',$time);
        return back()->with('time',Comment::orderBy('created_at','desc')->first());
        }
 
    }
    public function destroy($id){
       
     $comment = Comment::find($id)->first();
     $comment->delete();

        return redirect('users.index');
    }



    // ->with('first_post',Post::orderBy('created_at','desc')->first())

    
}
