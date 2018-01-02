<div class="comment-item">
    <div class="comment-title">
        <span class="name"><i class="fa fa-commenting-o"></i>{{$comment->user->name}}</span>
        <span class="date"><i
                    class="fa fa-clock-o"></i>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
        <a href=""></a>
        @if(auth()->check())
            <button type="button" class="btn btn-primary btn-xs modal-btn" data-toggle="modal"
                    data-target="#comment-modal-{{$comment->id}}">
                @lang('comment::messages.replyComment')
            </button>
        @endif
    </div>
    <div class="comment-body">
        <p>{{$comment->body}}</p>
    </div>
</div>
@include("comment::frontend.partials.modal")
<div class="child">
    @foreach($comment->children()->active()->get() as $index => $comment)
        @include('comment::frontend.partials.comment', [
        'comment' =>$comment,
        'commentable_id' => $commentable_id
        ])
    @endforeach
</div>
