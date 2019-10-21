@extends('layouts.app')
@section('content') 
<head>
        <link rel="stylesheet" href="{{asset('css/aboutus.css')}}">
</head>
<section id="page1">
        <div class="flex-center position-ref full-height">
            <div class="content forTitle">
                <div class="title m-b-md">
                    Music Compass
                </div>
                <section class="contentH2 py-2">
                  <h2>
                      <p>MusicCompassとは</p><p>そこはあなたの好きな音楽・気になるジャンルを、投稿を通じて他のユーザーと共有することができる場所</p>
                      <p>日本全国各地に出向いて、その土地・人と共に最高の音楽を楽しもう</p>
                      <p>音楽で人は変わるのではない</p><p>「あなたの音楽」こそ、世界につながるコンパスになる。</p>
                  </h2>
                </section>
            </div>
        </div>
    </section>
    @include('includes.footer')

@endsection