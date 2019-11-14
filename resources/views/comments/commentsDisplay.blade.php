@foreach($comments as $comment)
    <div class="display-comment">
        <div class="forFlex">
            <div class="proIMG"><img src="{{asset($comment->user->profile->avatar)}}" alt="{{$comment->user->name}}" style="border-radius:50%"></div>
            {{-- <div class="proIMG"><img src="{{asset($comment->profile->avatar)}}" alt="{{$comment->profile->user->name}}" style="border-radius:50%"></div> --}}
            <div class="writing">
                <strong><a href="{{route('profile.show',['user'=>$comment->user->id])}}">{{$comment->user->name }}</a></strong>
                <p id="commentBody">{{ $comment->body }}</p>
            </div>
        {{-- <form action="post" action="{{route('comment.delete',['id'=>comment->id])}}">
            @csrf 
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="削除する">
        </form> --}}
        @if($comment->user_id == Auth::user()->id)
            @component('components.btn-del')
                @slot('controller', 'comment')
                @slot('id',$comment->id)
                @slot('name', '「 '.$comment->body.' 」')
            @endcomponent
        @endif
        {{-- @if($profile->user_id == Auth::user()->id)
          @component('components.btn-del')
            @slot('controller', 'comment')
            @slot('id',$comment->id)
            @slot('name', '「 '.$comment->body.' 」')
          @endcomponent
        @endif --}}
        </div>
        <hr>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="hidden"@if(isset($post_id)) name="post_id" value="{{ $post_id }}" @else name="profile_id" value="{{ $profile_id }}"@endif/>
            </div>
        </form>
        {{-- @include('comments.commentsDisplay', ['comments' => $comment->replies]) --}}
    </div>
@endforeach 

{{-- リプライ用 --}}
{{-- @if($comment->parent_id != null) style="margin-left:40px;" @endif --}}