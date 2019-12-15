@foreach($comments as $comment)

{{-- <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif> --}}
        <section class="forFlex">
            <div class="proIMG"><img src="{{asset($comment->user->profile->avatar)}}" alt="{{$comment->user->name}}" style="border-radius:50%"></div>
            <div class="writing">
                <strong><a href="{{route('profile.show',['user'=>$comment->user->id])}}">{{$comment->user->name }}</a></strong>
                <p id="commentBody">{{ $comment->body }}</p>
            </div>
        @if($comment->user_id == Auth::user()->id)
            @component('components.btn-del')
                @slot('controller', 'comment')
                @slot('id',$comment->id)
                @slot('name', '「 '.$comment->body.' 」')
            @endcomponent
        @endif
    </section>
    <hr>


@endforeach 
