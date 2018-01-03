<?php
if (isset($product)) {
    $comments = $product->activeParentComments();
} elseif (isset($content)) {
    $comments = $content->activeParentComments();
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
                    'comment'          => $comment,
                    'commentable_id'   => $commentable_id,
                    'commentable_type' => $commentable_type,
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
                                <input type="hidden" name="commentable_id" value="{{ $commentable_id }}">
                                <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
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
                    {{--{{$comments->appends($_GET)->links()}}--}}
            </div>
        </div>
        <br>
    </section>
@endif
