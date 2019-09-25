@extends('layouts.app')
@section('content')

<div class="card">
        <div class="card-header">Edit Setting</div>
        <div class="card-body">
        @if(count($errors) > 0)
            <ul class="list-group">
                {{-- 1つ目のerrorjはただのオブジェクトなので、その後にファンクションであるallでエラーを表示させるようにしなければならないz --}}
                @foreach($errors->all() as $errors)
            <li class="list-group-item text-danger">{{$errors}}</li>
                @endforeach
            </ul>
        @endif
    <form action="{{route('profile.update2')}}" method="POST">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" class="form-control"value= "{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" class="form-control">
           </div>
            <div class="form-group text-center">
                <button type="submit"class="btn btn-success">Update Setting</button>
            </div>
        </form>
    </div>
</div>
@endsection