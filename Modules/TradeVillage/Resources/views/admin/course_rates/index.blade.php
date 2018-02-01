@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::course_rates.title.course_rates') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::course_rates.title.course_rates') }}</li>
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
                                <th>{{ trans('tradevillage::course_rates.table.course') }}</th>
                                <th>{{ trans('tradevillage::course_rates.table.value') }}</th>
                                <th>{{ trans('tradevillage::course_rates.table.user') }}</th>
                                <th data-sortable="false">{{ trans('tradevillage::course_rates.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($course_rates)): ?>
                            <?php foreach ($course_rates as $course_rate): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.course_rates.edit', [$course_rate->id]) }}">
                                        {{ $course_rate->id }}
                                    </a>
                                </td>
                                <td>
                                    @if( isset($courses))
                                        @foreach($courses as $course)
                                            @if( $course->courses_id == $course_rate->course_id && $course->locale == locale())
                                                <a href="{{ route('admin.tradevillage.course_rates.edit', [$course_rate->id]) }}">
                                                    {{ $course->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.tradevillage.course_rates.edit', [$course_rate->id]) }}">
                                        {{ $course_rate->value }}
                                    </a>
                                </td>

                                <td>
                                    @if( isset($users))
                                        @foreach($users as $user)
                                            @if( $user->id == $course_rate->user_id && $course->locale == locale())
                                                <a href="{{ route('admin.tradevillage.course_rates.edit', [$course_rate->id]) }}">
                                                    {{ $user->first_name.''.$user->last_name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.course_rates.destroy', [$course_rate->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('tradevillage::course_rates.table.course') }}</th>
                                <th>{{ trans('tradevillage::course_rates.table.value') }}</th>
                                <th>{{ trans('tradevillage::course_rates.table.user') }}</th>
                                <th>{{ trans('tradevillage::course_rates.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::course_rates.title.create course_rates') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.course_rates.create') ?>" }
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
