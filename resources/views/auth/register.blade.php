@extends('layouts.app')

@section('content')
<head>
     <link rel="stylesheet" href="css/register.css">
</head>

{{--  --}} 
    <div class="forImage">
    @include('includes.header') 
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
                    <h1>サインアップ</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                    <div class="row formRows">

                        <div class="form-group row col-xs-6">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row col-xs-6">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row col-xs-6">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="forSignIn">
                 <a href="{{ route('login') }}">サインインはこちら</a>
            </div>
          </div>
        </div>
        @include('includes.footer')
@endsection
