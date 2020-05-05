

@extends('layouts.app')

@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    </head>
    <section class="contents">
        @include('includes.header')
            <div class="container">
                   <div class="card">
                     <div class="card-header">
                       <h3>友達一覧</h3>
                     </div>
                      <div class="card-body">
                           <table class="table table-striped">
                                @foreach ($users as $person)
                                @if ($user->isFollowing($person->id) && $person->isFollowing($user->id))
                                <tr>
                                    <td>
                                       <a id="tableFont" href="@if($person->id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$person->id])}} @endif">{{ $person->name }}</a>
                                    </td>
                                </tr>
                                  @endif
                                  @endforeach
                           </table>
                   </div>
                </div>
             </div>
         </section>
      @include('includes.footer')
@endsection