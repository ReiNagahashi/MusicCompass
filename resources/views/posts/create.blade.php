@extends('layouts.app')
@section('content')
<head>
     <link rel="stylesheet" href="../css/create.css">
 </head>
<div class="card pt-5">  
        <div class="card-header">{{isset($post)? '投稿を編集する':'新規投稿'}}</div>
        <div class="card-body">
        @if(count($errors) > 0)
            <ul class="list-group">
                @foreach($errors->all() as $errors)
            <li class="list-group-item text-danger">{{$errors}}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{isset($post)? route('posts.update',['post'=>$post->id]) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                 @endif
                    <div class="form-group text-center">
                        <label for="title">タイトル</label>
                        <input type="text" name="title" class="form-control"value= "{{isset($post) ? $post->title:""}}">
                    </div>
                    <div class="form-group">
                            <label for="prefecture">県を選択</label>
                            <select name="prefecture_id" id="prefecture" class="form-control">
                               @foreach($prefectures as $prefecture)
                                 <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
                               @endforeach
                            </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="description">内容</label>
                        <textarea name="description" cols="10" rows="10" class="form-control" placeholder="※こちらに、イベントの日時や集合場所等についての詳細を含めてください。">{{isset($post) ? $post->description:""}}</textarea>
                    </div>
                    <div class="form-group formG_S">
                            <label for="genres">ジャンル</label>
                         @foreach($genres as $genre)
                            <div class="checkbox">
                                        <label><input type="checkbox" class="labelG_S" name="genres[]" value="{{$genre->id}}"
                                            @if(isset($post))
                                                @foreach($post->genres as $gen)
                                                    @if($genre->id == $gen->id)
                                                        checked
                                                    @endif
                                                 @endforeach                                            
                                            @endif>{{$genre->name}}
                                        </label>
                                   </div>
                                @endforeach
                    </div>
           　　     <div class="form-group text-center">
                        <label for="condition">参加条件</label>
                        <textarea name="condition" cols="5" rows="1" class="form-control" placeholder="例:演奏をじっくり楽しみたい人、お酒が飲める人etc...">{{isset($post) ? $post->condition:""}}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <label for="location">会場名</label>
                        <textarea name="location" cols="5" rows="2" class="form-control" >{{isset($post) ? $post->locationName:""}}</textarea>
                    </div> 
                    <div class="form-group">
                            <label for="location">会場のタイプ</label>
                            <select name="location_id" id="location" class="form-control">
                               @foreach($locations as $location)
                                 <option value="{{$location->id}}">{{$location->name}}</option>
                               @endforeach
                            </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="address">マップURL</label>
                        <textarea name="address" cols="5" rows="2" class="form-control" placeholder="https://www.google.co.jp/maps">{{isset($post) ? $post->address:""}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">画像を選択</label>
                        <input type="file" name="image"　class="form-control">
                    </div>
                    <button type="submit"class="btn btn-success btn-block">
                        送信する
                    </button>
                </form>
            </div>
        </div>
        @include('includes.footer')
        @endsection
