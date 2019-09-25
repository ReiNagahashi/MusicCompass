@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">自分の投稿<span class="ml-5">気になった投稿をクリックしよう。</span> <a href="{{route('posts.create')}}" class="btn btn-second　ml-5">新規投稿</a></div>
    <div class="card-body">
        @if(count($posts) > 0)
        <table class="table table-striped">
            <thead> 
                <th>Image</th>
                <th>Title</th>
                <th>Address</th>
            </thead> 
            <tbody>
                @foreach($posts as $post)
              <tr>
              <td><img src="{{asset($post->post_image)}}"alt="{{$post->title}}" height="90px" width="90px"
                style ="border-radius:50%"></td>
                <td>{{$post->title}}</td>
              <td>
                  {{-- ここのpostsはweb.phpのresourceからきているのだ --}}
              <a href="{{route('posts.show',['post' => $post->id])}}">{{$post->address}}</a>
              </td>
            </tr>
              @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center">まだ投稿はありません： <a href="{{route('posts.create')}}" class="btn btn-second">新規投稿</a></p>
        @endif
    </div>
</div>
{{$posts->links()}}
@endsection