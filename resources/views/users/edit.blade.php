@extends('layouts.app')
@section('content')

<head>
    <link rel="stylesheet" href="../css/create.css">
</head>

<div class="card pt-5">
        <div class="card-header">{{isset($user)?'プロフィールを編集':'プロフィールを作成'}}</div>
        <div class="card-body">
        @if(count($errors) > 0)
            <ul class="list-group">
                {{-- 1つ目のerrorjはただのオブジェクトなので、その後にファンクションであるallでエラーを表示させるようにしなければならないz --}}
                @foreach($errors->all() as $errors)
            <li class="list-group-item text-danger">{{$errors}}</li>
                @endforeach
            </ul>
        @endif
    <form action = "{{isset($user)? route('profile.update'):route('profile.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($user))
        @method('PUT')
        @endif
 
            <div class="form-group">
                <label for="age">年齢</label>
                <input type="text" name="age" class="form-control"value= "{{isset($user)?$user->profile->age: ""}}">
            </div>
            <div class="form-group formG_S">
                <label for="location">性別</label>
                        @foreach($sexes as $sex)
                        <label><input type="radio" class="labelG_S" id="sex" name="sex_id" value="{{$sex->id}}" class="form-control" @if(isset($user)) @if($user->profile->sex_id == $sex->id) checked @endif @endif>{{$sex->sex}}</label>
                        @endforeach
           </div>
           <div class="form-group">
                <label for="native">出身地</label>
                <input type="text" name="native" class="form-control"value= "{{isset($user)?$user->profile->native: ""}}">
           </div>
           <div class="form-group">
                <label for="favorite">お気に入りのアーティスト</label>
                <textarea name="favorite" cols="5" rows="2" class="form-control">{{isset($user)?$user->profile->favorite: ""}}</textarea>
            </div>
             <div class="form-group">
                <label for="interest">最近興味のある音楽のジャンル</label>
                <textarea name="interest" cols="5" rows="2" class="form-control">{{isset($user)?$user->profile->interest: ""}}</textarea>
            </div>
           <div class="form-group">
                <label for="intro">自己紹介</label>
                <textarea name="intro" cols="30" rows="10"class="form-control">{{isset($user)?$user->profile->intro: ""}}</textarea>
            </div>
            <div class="form-group">
                <label for="avatar">プロフィール画像</label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <label for="host_id">ホストステータス</label>
                <select name="host_id" class="form-control">
                    @foreach($hosts as $host)
                      <option value="{{$host->id}}"@if(isset($user)) @if($host->id == $user->profile->host_id) selected @endif @endif>{{$host->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-center">
                <button type="submit"class="btn btn-success">変更する</button>
            </div>
        </form>
    </div>
</div>
@endsection