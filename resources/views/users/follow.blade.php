@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="css/profile.css">
</head>
    <section class="contents">
        @include('includes.header')
            <div class="container">
                <div class="explanation">お互いがフォローをした友達の状態になることで、それぞれのプロフィール上でメッセージのやりとりを行うことが出来るようになります。</div>
                   <div class="card">
                     <div class="card-header">
                       <h3>友達一覧</h3>
                     </div>
                      <div class="card-body">
                       <div class="row">
                         <div class="col-md-5">
                           <table class="table table-striped">
                                @foreach ($users as $user)
                                @if (Auth::User()->isFollowing($user->id) && $user->isFollowing(Auth::User()->id))
                                <tr>
                                  <td>
                                      <a id="tableFont" href="@if($user->id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$user->id])}} @endif">{{ $user->name }}</a>
                                    </td>
                                    <td>
                                       <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" id="delete-follow-{{ $user->target_id }}" class="btn btn-danger">
                                                フォロー解除 
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                  @endif
                                  @endforeach
                           </table>
                         </div>
                         <div class="col-md-1 d-none d-lg-block d-print-block">
                           <hr>
                         </div>
                         <div class="col-md-6">
                             <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                               <li class="nav-item">
                                 <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">フォロー</a>
                               </li>
                               <li class="nav-item">
                                 <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">フォロワー</a>
                               </li>
                             </ul>
                             <div class="tab-content" id="pills-tabContent">
                               <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                     <table class="table table-striped">
                                        <tr>
                                            @foreach ($users as $user)
                                            @if (Auth::User()->isFollowing($user->id) &&! $user->isFollowing(Auth::User()->id)) 
                                            <td>
                                                <a id="tableFont" href="@if($user->id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$user->id])}} @endif">{{ $user->name }}</a>
                                              </td>
                                                 <td>
                                                    <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" id="delete-follow-{{ $user->target_id }}" class="btn btn-danger">
                                                            フォロー解除 
                                                        </button>
                                                    </form>
                                                 </td>
                                             @endif
                                             @endforeach
                                         </tr>
                                     </table>
                               </div>
                               <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <table class="table table-striped task-table">

                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                         @if ($user->isFollowing(Auth::User()->id) &&! Auth::User()->isFollowing($user->id))
                                                            <td phpclass="table-text">
                                                               <a id="tableFont" href="@if($user->id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$user->id])}} @endif">{{ $user->name }}</a>
                                                            </td>
                                                        <td>
                                                            <form action="{{url('follow/' . $user->id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                                                    フォロー
                                                                </button>
                                                            </form>
                                                        </td>
                               
                                                     @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                             </div>
                         </div>
                     </div>
                   </div>
                 </div>
               </div>
             </section>
             @include('includes.footer')
@endsection