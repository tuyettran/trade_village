@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::course_users.title.course_users') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::course_users.title.course_users') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('tradevillage::course_users.table.course') }}</th>
                                <th>{{ trans('tradevillage::course_users.table.user') }}</th>
                                <th>{{ trans('tradevillage::course_users.table.chapter') }}</th>
                                <th data-sortable="false">{{ trans('tradevillage::course_users.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($course_users)): ?>
                            <?php foreach ($course_users as $course_user): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.course_users.edit', [$course_user->id]) }}">
                                        {{ $course_user->id }}
                                    </a>
                                </td>

                                <td>
                                    @if( isset($courses))
                                        @foreach($courses as $course)
                                            @if( $course->courses_id == $course_user->course_id && $course->locale == locale())
                                                <a href="{{ route('admin.tradevillage.course_users.edit', [$course_user->id]) }}">
                                                    {{ $course->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    @if( isset($users))
                                        @foreach($users as $user)
                                            @if( $user->id == $course_user->user_id)
                                                <a href="{{ route('admin.tradevillage.course_users.edit', [$course_user->id]) }}">
                                                    {{ $user->first_name.''.$user->last_name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.tradevillage.course_users.edit', [$course_user->id]) }}">
                                        {{ $course_user->chapter }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.course_users.destroy', [$course_user->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('tradevillage::course_users.table.course') }}</th>
                                <th>{{ trans('tradevillage::course_users.table.user') }}</th>
                                <th>{{ trans('tradevillage::course_users.table.chapter') }}</th>
                                <th>{{ trans('tradevillage::course_users.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('tradevillage::course_users.title.create course_users') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.course_users.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
