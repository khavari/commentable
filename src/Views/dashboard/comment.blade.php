<tr>
    <td>{{$comment->id}}</td>
    <td>{{$comment->user->name}}</td>
    <td>{{$comment->body}}</td>
    <td>
        @if(is_null($comment->approve))
            <a class="btn btn-xs btn-default btn-flat" href="{{ url("dashboard/comments/$comment->id/approve") }}">
                <i class="fa fa-circle-o-notch"></i>
            </a>
        @elseif($comment->approve === 1)
            <a class="btn btn-success btn-xs btn-flat" href="{{ url("dashboard/comments/$comment->id/unapprove") }}">
                <i class="fa fa-check"></i>
            </a>
        @else
            <a class="btn btn-xs btn-danger btn-flat" href="{{ url("dashboard/comments/$comment->id/approve") }}">
                <i class="fa fa-check"></i>
            </a>
        @endif
    </td>
    <td>
        @if(is_null($comment->read_at))
            <span>@lang('comment::messages.unread')</span>
        @else
            {{\Carbon\Carbon::parse($comment->read_at)->diffForHumans()}}
        @endif
    </td>

    <td>
        @if($comment->trashed())
            <form action="{{ url("dashboard/comments/$comment->id/restore") }}"
                  method="post"
                  class="inline">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-xs btn-success btn-flat"
                        data-title="@lang('comment::messages.restore')">@lang('comment::messages.restore')</button>
            </form>
        @else
            <a type="button"
               class="btn btn-xs btn-primary btn-flat"
               href="{{ url("dashboard/comments/$comment->id/edit") }}"
               title="vault::messages.edit">@lang('comment::messages.edit')</a>

            <a type="button"
               class="btn btn-xs btn-info btn-flat"
               href="{{ url("dashboard/comments/$comment->id") }}"
               title="vault::messages.edit">@lang('comment::messages.reply')</a>

            <form action="{{ url("dashboard/comments/$comment->id") }}" method="post"
                  class="inline destroy">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-xs btn-danger btn-flat"
                        data-title="@lang('comment::messages.deleteMessage')">@lang('comment::messages.delete')</button>
            </form>
        @endif

    </td>

</tr>

