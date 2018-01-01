@extends(config("haddock.dashboardLayout"))
@section('title', trans('haddock::messages.menu manager'))
@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i
                            class="fa fa-dashboard"></i>&nbsp;&nbsp;@lang("vitrin::messages.dashboard")</a></li>
            <li><a href="{{ url('dashboard/comments') }}">@lang('comment::messages.manageComments')</a></li>
            <li><a>@lang('comment::messages.show')</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success animated fadeIn">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('comment::messages.manageComments')</h3>
                        <div class="box-tools">
                            <form action="{{url('dashboard/comments/')}}" method="get">
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <input type="text" name="search" class="form-control pull-right" placeholder="..."
                                           autofocus required
                                           value="<?php echo (isset($_GET['search'])) ? $_GET['search'] : ''; ?>">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-info">جستجو</button>
                                        <a href="{{url('dashboard/comments/')}}" class="btn btn-primary">انصراف</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td><b>@lang('comment::messages.id')</b></td>
                                <td>{{$comment->id}}</td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.name')</b></td>
                                <td>{{$comment->user->name}}</td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.email')</b></td>
                                <td>{{$comment->user->email}}</td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.comment')</b></td>
                                <td>{{$comment->body}}</td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.commentable_type')</b></td>
                                <td>{{$comment->commentable_type}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('comment::messages.status')</b></td>
                                <td>
                                    @if(is_null($comment->approve))
                                        <span>@lang('comment::messages.pending')</span>
                                    @elseif($comment->approve == 1)
                                        <span>@lang('comment::messages.approve')</span>
                                    @else
                                        <span>@lang('comment::messages.unapprove')</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.read_at')</b></td>
                                <td>{{\Carbon\Carbon::parse($comment->read_at)->diffForHumans()}}</td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.created_at')</b></td>
                                <td>{{$comment->created_at->DiffForHumans()}}</td>
                            </tr>

                            <tr>
                                <td><b>@lang('comment::messages.updated_at')</b></td>
                                <td>{{$comment->updated_at->DiffForHumans()}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success animated fadeIn">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('comment::messages.reply')</h3>
                    </div>
                    <form action="{{ url("dashboard/comments") }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="parent_id" value="{{$comment->id}}">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body" class="control-label">@lang('comment::messages.comment')</label>
                                    <textarea class="form-control" name="body" id="body" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-sm btn-flat btn-success">@lang('comment::messages.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('style')
@endsection


@section('script')
@endsection
