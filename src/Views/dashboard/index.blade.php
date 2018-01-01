@extends(config("haddock.dashboardLayout"))
@section('title', trans('haddock::messages.menu manager'))
@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i
                            class="fa fa-dashboard"></i>&nbsp;&nbsp;@lang("vitrin::messages.dashboard")</a></li>
            <li><a>@lang('comment::messages.manageComments')</a></li>
            <li><a>@lang('comment::messages.comments')</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <form action="{{url('dashboard/comments/')}}" method="get">
                            <select name="approve" class="form-control input-sm" onchange="this.form.submit()">
                                <option value="0">@lang('comment::messages.comments')</option>
                                <option value="pending" @if(request('approve') == 'pending') selected @endif>@lang('comment::messages.pending')</option>
                                <option value="unapprove" @if(request('approve') == 'unapprove') selected @endif>@lang('comment::messages.unapprove')</option>
                                <option value="approve" @if(request('approve') == 'approve') selected @endif>@lang('comment::messages.approve')</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                    <div class="box-body">


                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>@lang('comment::messages.id')</th>
                                <th>@lang('comment::messages.name')</th>
                                <th>@lang('comment::messages.comment')</th>
                                <th>@lang('comment::messages.status')</th>
                                <th>@lang('comment::messages.read_at')</th>
                                <th style="min-width: 165px;">@lang('comment::messages.action')</th>
                            </tr>

                            @foreach($comments as $comment)

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

                            @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="box-footer clearfix">
                        {{$comments->appends($_GET)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Add style --}}
{{------------------------------------------------------------}}
@section('style')
@endsection

{{-- Add script --}}
{{------------------------------------------------------------}}
@section('script')
@endsection
