@extends('layouts.app')
@section('content')
 <head>
        <link rel="stylesheet" href="../css/crud.css">
 </head>
<div class="card pl-0 pr-0 "> 
  <div class="container">
        <h2 class="card-header">
                {{$post->title}} 
        </h2>
        <img src="{{ asset($post->post_image)}}" alt="{{$post->title}}" width="100%">
        <div class="contentBox1"> 
            <div class="card-body">
                <div class="card-text mb-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>内容: </b>{{$post->description}}</li>
                        <li class="list-group-item"><b>参加条件: </b>{{$post->condition}}</li>
                        <li class="list-group-item"><b>詳細・連絡アドレス: </b>{{$post->address}}</li>
                        <li class="list-group-item"><b>ジャンル: </b>
                            @foreach($post->genres as $genre)
                               <span class="ml-2">{{$genre->name}}</span>
                            @endforeach
                        </li>
                        <li class="list-group-item"><p><b>Created By: </b><a href="@if($post->user_id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$post->user->id])}} @endif">
                                {{$post->user->name}}
                            </a></p></li>
                        <li class="list-group-item"><b>Created at : </b>{{$post->created_at->toFormattedDateString()}}</li>
                        
                    </ul>
                 </div>
                        @if($post->user_id == $user_id)
                    
                            <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-primary">edit</a>

                        @component('components.btn-del')
                            @slot('controller', 'posts')
                            @slot('id',$post->id)
                            @slot('name', '「 '.$post->title.' 」')
                        @endcomponent

                        @endif
                        <a href="{{route('attendees.single',['post' => $post->id])}}" class="btn btn-success">参加者一覧</a>
                        {{-- <a href="{{route('attendees.update',['post' => $post->id])}}" class="btn btn-info">参加する</a> --}}

                    <a href="/home" class="btn btn-primary">Back</a>


            <div class="card-footer">
                @include('comments.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                {{-- <p> 
                    <i class="seoicon-clock"></i> 
                    {{$time->created_at->toFormattedDateString()}}                                            </time>
                </p> --}}
                <hr/>
                  <h4>コメントを送信する</h4>
                     <form method="post" action="{{route('comments.store')}}">
                      @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                       <div class="form-group">
                           <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection