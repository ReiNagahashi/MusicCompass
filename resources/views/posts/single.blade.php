@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="../css/home.css">
</head>
    <section class="contents forImage">
        @include('includes.header')
         <div class="container">
              <div class="panel text-center parentPanel">
                <div class="panel-body">
                    <table class="table table-striped">                              
                        <thead>
                            <th>参加者一覧</th>
                        </thead> 
                        <tbody>
                            @foreach ($users as $user)
                            {{-- @if(count($post->target_id == $post->user->id) > 0) --}}

                                <tr>
                                        {{-- <a href="{{isset($user->profile->user_id)? route('profile.show',['profile'=>$profile->id]) : route('profile.nothing')}}"> --}}
                                    @if ($user->isAttending($post->id))
                                            <td class="table-text"><div>
                                                    <a href="@if($user->id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$user->id])}} @endif">
                                                        {{ $user->name }}
                                                    </a>
                                           </div></td>
                                    @endif
                                </tr>
                                {{-- @else
                                   <h1 class="text-center">現在参加しているユーザーはいません。</h1>
                                @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($post->user_id !== $user_id)
                <div class="panel-footer">
                    @if (Auth::user()->isAttending($post->id))
                        <form action="{{url('cancel/' . $post->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" id="delete-attend-{{ $post->target_id }}" class="btn btn-danger">
                                参加キャンセル
                            </button>
                        </form> 
                    @else 
                      <form action="{{url('attend/' . $post->id)}}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" id="attend-post-{{ $post->user->id }}" class="btn btn-success">
                            参加する
                        </button>
                     </form>
                    @endif 
                </div>
                @endif
                <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-primary">
                    戻る
                </a>
              </div>
            </div>
    </section>
    @include('includes.footer')

@endsection