<div class="modal fade" id="comment-modal-{{$comment->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{url('comment/submit')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <input type="hidden" name="commentable_id" value="{{ $commentable_id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('comment::messages.replyComment')</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="body"
                               class="control-label">@lang('comment::messages.comment')</label>
                        <textarea class="form-control" name="body" id="body" required rows="4">{{old('body')}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('comment::messages.submitComment')</button>
                </div>
            </form>
        </div>
    </div>
</div>
