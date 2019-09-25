@extends('layouts.app')
@section('content')
  @if(Auth::user())
    <div class="container">
      <div class="text-center"><h1>ようこそ</h1></div>
    </div>
    {{-- {{$posts->user->name}} さん --}}
  @endif
  <div class="card">
      <div class="card-header">All Post <a href="{{route('posts.create')}}" class="btn btn-second">新規投稿</a></div>
      <div class="card-body">
          @if(count($posts) > 0)
          <table class="table table-striped">
              <thead>
                  <th>Image</th> 
                  <th>タイトル</th>  
                  <th>都道府県</th>
                  <th>ジャンル</th>
                  <th>作成日</th>
              </thead> 
              <tbody>
                  @foreach($posts as $post)
                <tr>
                　 <td>
                      <a href="{{route('posts.show',['profile' => $profile->id])}}">
                          <img src="{{asset($post->post_image)}}"alt="{{$post->title}}" height="90px" width="90px"
                          　style ="border-radius:50%">
                      </a>
                  　</td>
                    <td>
                      <a href="{{route('posts.show',['post' => $post->id])}}">
                      　 {{$post->title}}
                      </a>
                    </td>
                      <td>
                        　 {{$post->prefecture->name}}
                      </td>
                    <td>
                      <a href="{{route('posts.show',['post' => $post->id])}}">
                        @foreach($post->genres as $genre)
                          {{$genre->name}}
                        @endforeach
                      </a>
                    </td>
                    <td>
                       {{$post->created_at->toFormattedDateString()}}
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>
          @else
          <p class="text-center">No posts found.</p>
          @endif
      </div>
  </div>
  {{$posts->links()}}
  @endsection