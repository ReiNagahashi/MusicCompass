@extends('layouts.app')

@section('content')
  <head>
    <link rel="stylesheet" href="css/home.css">
  </head>
      <section class="contents forImage">
          @include('includes.header')
           <div class="container">
                <form action="{{('/home')}}" method="GET">
                          <div class="form-group kywordAndSubmit">
                            <input type="text" name="keyword"  class="search form-control" placeholder="ここにキーワードを入力">
                            <input type="submit" value="検索" class="btn btn-info submitForKeyword">
                          </div>
                      </form>
                      <form action="{{('/home')}}" class="forSecondButtons" method="GET">
                        <div class="row">
                          <div class="form-group col-md-5">
                              <label for="prefecture">都道府県で検索</label>
                              <select name="prefecture_id" id="prefecture"  class="form-control">
                              @foreach($prefectures as $prefecture)
                                <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
                              @endforeach
                              </select>
                          </div>
                          <div class="form-group col-md-5">
                              <label for="location">会場のタイプで検索</label>
                              <select name="location_id" id="location"  class="form-control">
                              @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                              @endforeach
                              </select>
                          </div>
                          <div class="col-md-2">
                            <label for="submit">Let's go!</label>
                            <input type="submit" value="検索" class="form-control btn btn-info">
                          </div>
                        </div>
                      </form>
                    {{-- <a class="btn btn-success" href="{{route('posts.create')}}">新規投稿</a> --}}
                    @if(isset(Auth::user()->id))
                      @component('components.btn-create_edit')
                        @slot('controller','posts.store')
                        @slot('prefectures',$prefectures)
                        @slot('genres',$genres)
                        @slot('locations',$locations)
                      @endcomponent
                    @endif
                    {{-- ここからkeywordのみ --}}
                    @if(isset($keyword))
                    <section class="card cardSearch">
                      <div class="card-body">
                      <h1>検索結果：{{$keyword}}</h1>
                        <div class="row post">
                            @if(count($keyPosts) > 0)
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
                                <h5>{{$keyPost->locationName}}（{{$keyPost->prefecture->name}}）</h5>
                                <div class="forJustify mt-4">
                                    <a href="{{route('posts.show',['post' => $keyPost->id])}}" class="btn btn-success">詳細を見る</a><small>{{$keyPost->created_at->toFormattedDateString()}}</small>
                                </div>
                              </div>
                            </div>
                              @endforeach
                              @else
                              <section class="notFoundPage">
                                <div class="container">
                                  <h3>投稿がみつかりませんでした。</h3>
                                </div>
                              </section>
                              @endif
                          </div>
                          <div class="row mt-4">
                              <div class="col-5"></div>
                              <div class="col-2"> {{$keyPosts->links()}}</div>
                              <div class="col-5"></div>
                          </div>
                      </div>
                    </section>
                    @endif
                {{-- ここからフォーム入力なしで都道府県・ロケーションのみで検索 --}}
                @if(isset($prefecture_id) &&! isset($keyword))
                <section class="card cardSearch">
                  <div class="card-body">
                      <h1>検索結果</h1>
                    <div class="row post">
                        @if(count($keyPres) > 0)
                        @foreach($keyPres as $keyPre)
                        @if($keyPre->location_id == $location_id)
                        <div class="col-md-4">
                            <div class="card-img">
                                <a href="{{route('posts.show',['post' => $keyPre->id])}}">
                                    <img src="{{asset($keyPre->post_image)}}"alt="{{$keyPre->title}}" height="225px" width="100%">
                                </a>
                            </div>
                            <div class="card-content">
                            <div class="Title">
                            <h3>{{$keyPre->title}}</h3>
                            </div>
                            <h5>{{$keyPre->locationName}}（{{$keyPre->prefecture->name}}）</h5>
                            <div class="forJustify mt-4">
                                <a href="{{route('posts.show',['post' => $keyPre->id])}}" class="btn btn-success">詳細を見る</a><small>{{$keyPre->created_at->toFormattedDateString()}}</small>
                            </div>
                          </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <section class="notFoundPage">
                          <div class="container">
                            <h3>投稿がみつかりませんでした。</h3>
                          </div>
                        </section>
                        @endif
                      </div>
                      <div class="row mt-4">
                          <div class="col-5"></div>
                          <div class="col-2"> {{$keyPres->links()}}</div>
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
                    <h5>{{$post->locationName}}（{{$post->prefecture->name}}）</h5>
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
                     <h5>{{$mypost->locationName}}（{{$mypost->prefecture->name}}）</h5>
                     <div class="forJustify mt-4">
                        <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-success">詳細を見る</a><small>{{$mypost->created_at->toFormattedDateString()}}</small>
                     </div>
                   </div>
                </div>
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
