<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Musics Compass</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Beth+Ellen&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('owlcarousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('owlcarousel/owl.theme.default.min.css')}}"> --}}

        <!-- Styles -->
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light head links">
                <a class="navbar-brand links" href="#">Music Compass</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        @if (Route::has('login'))
                        @auth
                  <div class="navbar-nav">
                        @else
                       <a class="nav-item nav-link links" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                       <a class="nav-item nav-link links" href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                        <a class="nav-item nav-link links" href="{{ url('/home') }}">Home</a>
                        <a class="nav-item nav-link links" href="{{ route('home.about') }}">About us</a>
                  </div>
                  @endif
                </div>
              </nav>
            <section id="page1">
              <div class="flex-center position-ref full-height">
             
                 <div class="content forTitle">
                    <div class="title m-b-md">
                            Music<br> Compass
                    </div>
                   <section class="contentH2">
                    <h1>
                        未知なる音楽と未知なる世界へ<br>
                        音楽を通じて人と繋がる。<br>
                    </h1>
                  </section>
                </div>
            </div>
        </section>
        {{-- <section id="centerPage">
            <div class="container parentbox">
                <div id="direction">
                    <div class="txtL">初めての方へ</div>
                    <div id="forNew">
                        <div class="detail txtM">このサイトの使い方　→　Aboutus</div>
                        <div class="detail txtM">登録はこちら　→　Registration</div>
                    </div>
                 </div>
                <div id="gallery">
                    <div class="txtL">同じファンと投稿を通じて繋がろう</div>
                    <div class="owl-carousel owl-theme">
                        <div class="card imageContent">
                            <img src="uploads/images/image1.png" class="card-img-top">
                            <div class="card-body">
                                <h5>Post Title</h5>
                                <p>Comments</p>
                            </div>
                        </div>
                        <div class="card imageContent">
                            <img src="uploads/images/image2.png" class="card-img-top">
                            <div class="card-body">
                                    <h5>Post Title</h5>
                                    <p>Comments</p>
                            </div>
                        </div>
                        <div class="card imageContent">
                            <img src="uploads/images/image3.png" class="card-img-top">
                            <div class="card-body">
                                    <h5>Post Title</h5>
                                    <p>Comments</p>
                            </div>
                        </div>
                        <div class="card imageContent">
                            <img src="uploads/images/image4.png" class="card-img-top">
                            <div class="card-body">
                                    <h5>Post Title</h5>
                                    <p>Comments</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  
        </section> --}}
        <section id="page2">
                <div class="flex-center position-ref full-height"> 
                    <form action="{{('/home')}}" method="GET">
                        <div class="form-group">
                            <label for="keyword" id="forLabel">さあ、ここから行きたい場所を検索してみよう！</label>
                            <input type="text" name="keyword"  class="form-control search">
                        </div>
                       
                        <input type="submit" class="btn btn-info">
                    </form>
                </div>
            </section> 
            @include('includes.footer')

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="{{asset('jquery.min.js')}}"></script>
        <script src="{{asset('owlcarousel/owl.carousel.min.js')}}"></script>    
        {{-- <script>
        $('.owl-carousel').owlCarousel({
            autoplay:true,
            autoplayHoverPause:true,
            // loop:true,
            // items:3,
            // stagePadding:5,
            // margin:3,
            // lazyload:true,
            // responsive:{
            //     728:{
            //         items:2,
            //         dots:false
            //     },
            //     960:{
            //         items:3,
            //         dots:true
            //     },
            //     1200:{
            //         items:4,
            //         dots:true
            //     }
            // }
        });
    </script> --}}
    </body>
</html>

