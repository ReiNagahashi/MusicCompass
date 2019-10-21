@extends('layouts.app')

@section('content')
    <head>
        <link rel="stylesheet" href="css/register.css">
    </head>
     {{--  --}}
     <div class="forImage">
            @include('includes.header') 
            <div class="container">
                <hr>
                <div class="text-center">
                        <h1 id="travel">早速、音楽の旅に出かけよう</h1>
                        <div class="signUpBox">
                           <div id="faceBox">
                               <div class="facebookPosition">
                                   <label for="name">Login With</label>
                                   <a href="{{ url('login/facebook')}}" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                               </div>
                           </div>
                         <div class="vl"></div>
                    <div class="join-content-box" id="passBox">
                        <h2>サインイン</h2>
                    <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row formRows">
                                    <div class="form-group row col-xs-6">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row col-xs-6">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row col-xs-6">
                                    <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                            <div class="form-group ">
                                    <button type="submit" class="btn btn-primary col-lg-6 mt-1">
                                        {{ __('Login') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link col-lg-6" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                            </div>
                        </form>
                  </div>
                </div>
              <div class="forSignIn">
                <a href="{{ route('register') }}">登録はこちら</a>
              </div>
          </div>
        </div>
        @include('includes.footer')

@endsection


