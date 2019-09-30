@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data" class="pt-5">
    @csrf
        <input id="image" type="file" name="image">
        <button type="submit">
           アップロード
        </button>
    </form>
    @foreach($images as $image)
        <div>
            <img src="{{ $image->image }}" alt="image" style="width: 30%; height: auto;"/>
        </div>
    @endforeach
    @endsection