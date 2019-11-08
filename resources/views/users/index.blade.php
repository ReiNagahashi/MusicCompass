@extends('layouts.app')
@section('content')

   <head>
        <link rel="stylesheet" href="css/profile.css">
   </head>

   {{--  --}}
   @if(isset($user->profile))
      <section class="contents">
            @include('includes.header')
         <div class="container">
                 <div class="contentBox1">
                   <div class="card-header">
                    <div class="row">
                     <section class="col-md-5" id="profileIMG">
                     <img src="{{asset($user->profile->avatar)}}" alt="{{$user->name}}" width="100%"height="100%" style="border-radius:10%">
                     </section>
                     <div class="col-md-2 null">

                     </div>
                     <section class="col-md-5">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">名前： {{$user->name}}　年齢： {{$user->profile->age}} 　性別： {{$user->profile->sex->sex}}  出身： {{$user->profile->native}} </li>
                        <li class="list-group-item"><a href="/users" class="mr-5">友達</a><a href="{{route('profile.edit',['id'=>$user->id])}}">編集</a></h1></li>
                            <li class="list-group-item">好きなアーティスト： {{$user->profile->favorite}}</li>
                            <li class="list-group-item">気になるジャンル： {{$user->profile->interest}}</li>
                            <li class="list-group-item">ホストステータス：{{$user->profile->host->name}}</li>
                        </ul>
                     </section>
                   </div>
                 </div>
                </div>
                <div class="row text-center forH">
                  <div class="col-md-4"><hr></div>
                     <h1 class="col-md-4">Introduction</h1>
                   <div class="col-md-4"><hr></div>
                </div>

                 <div class="contentBox1">
                     <ul class="list-group list-group-flush">
                         <li class="list-group-item">{{$user->profile->intro}} </li>
                     </ul>
                 </div>
               </div>
             </section>
             @else
             <section class="contents">
                @include('includes.header')
                    <div class="container">
                        <div class="text-center comment">
                            <h1>まだプロフィールを作成していないようです。
                            <a href="/create-profile">こちら</a>で作成できます。</h1>
                        </div>
                    </div>
             </section>
         @endif
         @include('includes.footer')
         @endsection
             