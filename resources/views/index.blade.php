@extends('layouts.app')

@section('content')
<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = new Aws\S3\S3Client([
    'version'  => 'latest',
    'region'   => 'ap-northeast-1',
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>
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