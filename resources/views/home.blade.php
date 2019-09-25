@extends('layouts.app')

@section('content')
  <head>
    <link rel="stylesheet" href="css/home.css">
  </head>
      <section class="contents forImage">
          @include('includes.header')
           <div class="container">
                <form action="{{('/home')}}" method="GET">
                        <div class="form-group">
                            <input type="text" name="keyword"  class="form-control search" placeholder="ここにキーワードを入力">
                        </div>
                            <input type="submit" value="検索" class="btn btn-info float-right mb-3">
                    </form>
                    <a class="btn btn-success" href="{{route('posts.create')}}">新規投稿</a>
                    @if(isset($keyword))
                      <section class="card cardSearch">
                        <div class="card-body">
                          <h1>検索結果：{{$keyword}}</h1>
                          <div class="row post">
                              @foreach($keyPosts as $keyPost)
                              <div class="col-md-4">
                                  <div class="card-img">
                                      <a href="{{route('posts.show',['post' => $keyPost->id])}}">
                                          <img src="{{asset($keyPost->post_image)}}"alt="{{$keyPost->title}}" height="225px" width="100%">
                                      </a>
                                  </div>
                                  <div class="card-content">
                                  <div class="Title">
                                  <h3>{{$keyPost->title}}</h3>
                                  </div>
                                  <h5>{{$keyPost->location_name}}（{{$keyPost->prefecture->name}}）</h5>
                                  <div class="forJustify mt-4">
                                      <a href="{{route('posts.show',['post' => $keyPost->id])}}" class="btn btn-success">詳細を見る</a><small>{{$keyPost->created_at->toFormattedDateString()}}</small>
                                  </div>
                                </div>
                              </div>
                                @endforeach
                            </div>
                            <div class="row mt-4">
                                <div class="col-5"></div>
                                <div class="col-2"> {{$keyPosts->links()}}</div>
                                <div class="col-5"></div>
                            </div>
                        </div>
                      </section>
                      @endif

         @if(count($posts) == 0 && count($myposts) == 0)

          <h2 class="text-center comment mt-5">まだ投稿がありません。<a href="{{route('posts.create')}}">こちら</a>から投稿してください！</h2>
         @else
             @if(count($posts) > 0)
             <section class="card　cardSearch2">
                <div class="card-body forBack">
               <h1>最新の投稿：</h1>
                 <div class="row post">
                    @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="card-img">
                                <a href="{{route('posts.show',['post' => $post->id])}}">
                                        <img src="{{asset($post->post_image)}}"alt="{{$post->title}}" height="225px" width="100%">
                                </a>
                        </div>
                        <div class="card-content">
                        <div class="Title">
                        <h3>{{$post->title}}</h3>
                        </div>
                    <h5>{{$post->location_name}}（{{$post->prefecture->name}}）</h5>
                         <div class="forJustify mt-4">
                            <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-success">詳細を見る</a><small>{{$post->created_at->toFormattedDateString()}}</small>
                         </div>
                       </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-5"></div>
                    <div class="col-2"> {{$posts->links()}}</div>
                    <div class="col-5"></div>
                </div>
                @endif
  
                @if(count($myposts) > 0)
                <h1>自分の投稿：</h1>
                <div class="row post">
                @foreach($myposts as $mypost)
                    
                @if(Auth::user()->id == $mypost->user_id)
                    <div class="col-md-4">
                        <div class="card-img">
                          <a href="{{route('posts.show',['post' => $mypost->id])}}">
                              <img src="{{asset($mypost->post_image)}}"alt="{{$mypost->title}}" height="225px" width="100%">
                          </a>
                        </div>
                    <div class="card-content">
                    <div class="Title">
                    <h3>{{$mypost->title}}</h3>
                    </div>
                     <h5>{{$mypost->location_name}}（{{$mypost->prefecture->name}}）</h5>
                     <div class="forJustify mt-4">
                        <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-success">詳細を見る</a><small>{{$mypost->created_at->toFormattedDateString()}}</small>
                     </div>
                   </div>
                </div>
                @endif
                @endforeach
            </div>
          @endif
            <div class="row mt-4">
                    <div class="col-5"></div>
                    <div class="col-2"> {{$myposts->links()}}</div>
                    <div class="col-5"></div>
                </div>
             </div>
            </section>
          </div>
       @endif
    </section>
   @include('includes.footer')
@endsection
