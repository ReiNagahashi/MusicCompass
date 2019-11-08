@foreach($comments as $comment)
    <div class="display-comment">
        <div class="forFlex">
            <div class="proIMG">@if(isset($profile_id))<img src="{{asset($comment->profile->avatar)}}" alt="{{$comment->profile->user->name}}" style="border-radius:50%">@else<img src="{{asset($comment->user->profile->avatar)}}" alt="{{$comment->user->name}}" style="border-radius:50%">@endif</div>
            {{-- <div class="proIMG"><img src="{{asset($comment->profile->avatar)}}" alt="{{$comment->profile->user->name}}" style="border-radius:50%"></div> --}}
            <div class="writing">
                <strong><a href="@if( $comment->user_id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$comment->user->id])}} @endif">{{isset($profile_id)? $comment->profile->user->name : $comment->user->name }}</a></strong>
                <p id="commentBody">{{ $comment->body }}</p>
            </div>
        {{-- <form action="post" action="{{route('comment.delete',['id'=>comment->id])}}">
            @csrf 
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="削除する">
        </form> --}}
        @component('components.btn-del')
            @slot('controller', 'comment')
            @slot('id',$comment->id)
            @slot('name', '「 '.$comment->body.' 」')
        @endcomponent
        </div>
        <hr>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            @if(isset($post_id))
            <div class="form-group">
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}" /> --}}
            </div>
            @else
            <div class="form-group">
                <input type="hidden" name="profile_id" value="{{ $profile_id }}" />
                {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}" /> --}}
            </div>
            @endif
            {{-- <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" /> 
            </div> --}}
        </form>
        {{-- @include('comments.commentsDisplay', ['comments' => $comment->replies]) --}}
    </div>
@endforeach 

{{-- リプライ用 --}}
{{-- @if($comment->parent_id != null) style="margin-left:40px;" @endif --}}