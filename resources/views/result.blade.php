@extends('layouts.app')
@section('content')

<!-- Stunning Header -->

<div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
        <h1 class="stunning-header-title">Search results: {{$keyword}}</h1>
        </div>
    </div>
    
    <!-- End Stunning Header -->
    
    <!-- Post Details --> 
    
    
    <div class="container">
        <div class="row medium-padding120">
            <main class="main">

                <div class="row">
                    @if($posts->count()>0)
                            <div class="case-item-wrap">
                                @foreach($posts as $post)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="case-item">
                                        <div class="case-item__thumb">
                                          <a href="{{route('posts.show',['post' => $post->id])}}">
                                            <img src="{{asset($post->post_image)}}" alt="our case"　class="mt-3" height="150px" width="120px"
                                            style ="padding:10px;">
                                          </a>
                                        </div>
                                             <h6 class="case-item__title"><a href="{{route('posts.show',['post' => $post->id])}}">{{$post->title}}</a></h6>
                               　　  </div>
                                </div>
                                @endforeach
                            </div>
                        {{-- 　　  <div class="paginate">
                                 {{ $posts->render('pagination::bootstrap-4') }}
                           　 </div>  --}}
                        @else
                        <h1 class="text-center">投稿が見つかりません。</h1>
                        @endif
                 </div>
         </div>

         @endsection