@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong><a href="@if( $comment->user_id == Auth::user()->id) {{route('profile.index')}} @else {{route('profile.show',['user'=>$comment->user->id])}} @endif">{{ $comment->user->name }}</a></strong>
        <p id="commentBody">{{ $comment->body }}</p>
        <hr>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}" /> --}}
            </div>
            {{-- <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div> --}}
        </form>
        {{-- @include('comments.commentsDisplay', ['comments' => $comment->replies]) --}}
    </div>
@endforeach 