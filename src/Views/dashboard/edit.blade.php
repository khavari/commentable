@extends(config("comment.dashboardLayout"))
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
                        <h3 class="box-title">@lang('comment::messages.edit')</h3>
                    </div>
                    <form action="{{ url("dashboard/comments/$comment->id") }}" method="post">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body" class="control-label">@lang('comment::messages.comment')</label>
                                    <textarea class="form-control" name="body" id="body" rows="4">{{ $comment->body }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-sm btn-flat btn-success">@lang('comment::messages.update')</button>
                        </div>
                    </form>
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
