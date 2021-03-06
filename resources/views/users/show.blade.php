
@extends('layouts.app')
@section('content')

    <head>
        <link rel="stylesheet" href="../css/profile.css">
    </head>

    {{--  --}}
    <section class="contents">
        @include('includes.header')
        <div class="container">
            @if(isset($user->profile))
                <div class="contentBox1">
                    <div class="card-header">
                        <div class="row">
                            <section class="col-md-5" id="profileIMG">
                                <img src="{{asset($user->profile->avatar)}}" alt="{{$user->name}}" width="100%"
                                     height="100%" style="border-radius:10%">
                            </section>
                            <div class="col-md-2 null">

                            </div>
                            <section class="col-md-5">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">名前： {{$user->name}} 年齢： {{$user->profile->age}}
                                        性別： {{$user->profile->sex->sex}} 出身： {{$user->profile->native}} </li>
                                    <li class="list-group-item"><a
                                            href="{{route('profile.showFollow',['user'=>$user->id])}}" class="mr-5">フォロワー
                                            ( {{$follower_count}} )</a>@if($login_user == $user->id)<a
                                            href="{{route('profile.edit',['id'=>$user->id])}}">編集</a>@endif</h1></li>
                                    <li class="list-group-item">好きなアーティスト： {{$user->profile->favorite}}</li>
                                    <li class="list-group-item">気になるジャンル：
                                        @foreach($user->profile->genres as $genre)
                                            <span class="ml-2">{{$genre->name}}</span>
                                        @endforeach
                                    </li>
                                    {{-- <li class="list-group-item">ホストステータス：{{$user->profile->host->name}}</li> --}}

                                    {{-- ここに、メッセージ機能を盛り込んでいく --}}

                                </ul>
                                @if($login_user != $user->id)
                                    @if(Auth::user()->isfollowing($user->id))
                                        <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" id="delete-follow-{{ $user->target_id }}"
                                                    class="btn btn-danger mt-3">
                                                フォロー解除
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{url('follow/' . $user->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" id="follow-user-{{ $user->id }}"
                                                    class="btn btn-success mt-3">
                                                フォロー
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </section>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="leftIntro">
                        <div class="row text-center forH">
                            <div class="col-md-4">
                                <hr>
                            </div>
                            <h1 class="col-md-4">Introduction</h1>
                            <div class="col-md-4">
                                <hr>
                            </div>
                        </div>
                        <div class="contentBox1">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{$user->profile->intro}} </li>
                            </ul>
                        </div>
                    </div>
                    @if(Auth::user()->isFollowing($user->id) && $user->isFollowing(Auth::user()->id) || $login_user == $user->id)
                        <div class="rightComment">
                            <div class="row text-center forH">
                                <div class="col-md-4">
                                    <hr>
                                </div>
                                <h1 class="col-md-4">ChatCorner</h1>
                                <div class="col-md-4">
                                    <hr>
                                </div>
                            </div>
                            <section class="contentBox1">
                                @include('comments.commentsDisplay', ['comments' => $user->profile->comment_for_users, 'profile_id' => $user->profile->id])
                                {{-- <p>
                                    <i class="seoicon-clock"></i>
                                    {{$time->created_at->toFormattedDateString()}}                                            </time>
                                </p> --}}
                                <h4>コメントを送信する</h4>
                                <form method="post" action="{{route('comments.store')}}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="body"></textarea>
                                        <input type="hidden" name="profile_id" value="{{ $user->profile->id }}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Add Comment"/>
                                    </div>
                                </form>
                            </section>
                        </div>　
                    @endif
                </div>
            @elseif($login_user != $user->id)
                <div class="text-center comment">
                    <h1>{{$user->name}} さんはまだプロフィールを作成していないようです。</h1>
                </div>
            @else
                <div class="text-center comment">
                    <h1>まだプロフィールを作成していないようです。
                        <a href="/create-profile">こちら</a>で作成できます。</h1>
                </div>
        </div>
    </section>
    @endif
    @include('includes.footer')
@endsection