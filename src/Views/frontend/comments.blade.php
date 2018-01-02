<?php
if (isset($product)) {
    $comments = $product->comments()->active()->parent()->get();
} elseif (isset($content)) {
    $comments = $content->comments()->active()->parent()->get();
} else {
    $comments = null;
}
?>
@if($comments && setting('enableComment') == 1)
    <section class="container">
    <br>
    <div class="row box-comments @if(in_array(app()->getLocale() , ['fa','ar'])) rtl @else ltr @endif">
        <br>
        <div class="col-md-12">
            @if (session()->has('successCommit'))
                <div class="alert alert-success" role="alert">{{session('successCommit')}}</div>
            @endif
            @foreach($comments as $comment)
                @include('comment::frontend.partials.comment', [
                'comment' =>$comment,
                'commentable_id' => $commentable_id
                ])
            @endforeach
            @if(auth()->guest())
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-commenting-o"></i>
                            @lang('comment::messages.submitComment')</h3>
                    </div>
                    <div class="panel-body">
                        @lang('comment::messages.needLoginMessage')
                        <a href="{{url('/auth/login')}}" class="label label-success"
                           target="_blank">@lang('comment::messages.login')</a>
                    </div>
                </div>
            @else
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-commenting-o"></i>
                            @lang('comment::messages.submitComment')</h3>
                    </div>
                    <div class="panel-body">


                        <form action="{{url('comment/submit')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="commentable_id"
                                   value="{{ $product->id or $content->id }}">
                            <div class="form-group">
                                <label for="body"
                                       class="control-label">@lang('comment::messages.comment')</label>
                                <textarea class="form-control" name="body" id="body"
                                          rows="4" required>{{old('body')}}</textarea>
                            </div>
                            <div class="form-group">

                                <button type="submit"
                                        class="btn btn-sm btn-flat btn-success">@lang('comment::messages.submitComment')</button>
                            </div>

                        </form>

                    </div>
                </div>
            @endif
        </div>
    </div>
    <br>
    </section>
@endif

<style>

    .box-comments {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        background: #fff;
    }
    .comment-item {
        border: 1px solid #bad8e7;
        padding: 15px;
        margin-bottom: 15px;
        background: #d2eaf6;
        font-size: 13px;
        border-radius: 0px;
        position: relative;
    }

    .box-comments.rtl .comment-item .modal-btn {
        float: left;
    }
    .box-comments.ltr .comment-item .modal-btn {
        float: right;
    }
    .box-comments.ltr .child{
        margin-left: 15px;
    }
    .box-comments.rtl .child{
        margin-right: 15px;
    }
    .comment-item .comment-title .name {
        display: inline-block;
        margin-bottom: 10px;
    }

    .comment-item .comment-title .date {
        display: inline-block;
        margin-bottom: 20px;
        margin: 0px 15px;
    }

    .box-comments.rtl .comment-item .comment-title .fa {
        padding-left: 5px;
    }
    .box-comments.ltr .comment-item .comment-title .fa {
        padding-right: 5px;
    }

    .comment-item .comment-body p {

        line-height: 25px;
    }

</style>

