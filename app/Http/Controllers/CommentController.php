<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
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

        Comment::create($input);
        // return redirect(route('posts.show',['post' => $post->id]));
       // return redirect(route('posts.show'))->with('time',$time);
        return back()->with('time',Comment::orderBy('created_at','desc')->first());

    }

    // ->with('first_post',Post::orderBy('created_at','desc')->first())

    
}
