@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::events.title.events') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::events.title.events') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.events.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::events.button.create events') }}
                    </a>
                </div>
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
                                <th>{{ trans('tradevillage::events.table.image') }}</th>
                                <th>{{ trans('tradevillage::events.table.title') }}</th>
                                <th>{{ trans('tradevillage::events.table.village') }}</th>
                                <th>{{ trans('tradevillage::events.table.start_time') }}</th>
                                <th>{{ trans('tradevillage::events.table.end_time') }}</th>
                                <th>{{ trans('tradevillage::events.table.address') }}</th>
                                <th data-sortable="false">{{ trans('tradevillage::events.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($events)): ?>
                            <?php foreach ($events as $events): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}">
                                        {{ $events->id }}
                                    </a>
                                </td>
                                <td>
                                    <img src="{{ Imagy::getThumbnail($events->feature_image['path'].'', 'smallThumb') }}"/>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}">
                                        {{ $events->translate(locale())->title }}
                                    </a>
                                </td>
                                <td>
                                    @if( isset($villages))
                                        @foreach($villages as $village)
                                            @if( $village->villages_id == $events->village_id && $village->locale == locale())
                                                <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}">
                                                    {{ $village->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}">
                                        {{ $events->start_time }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}">
                                        {{ $events->end_time }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}">
                                        {{ $events->translate(locale())->address }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.events.edit', [$events->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.events.destroy', [$events->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('tradevillage::events.table.image') }}</th>
                                <th>{{ trans('tradevillage::events.table.title') }}</th>
                                <th>{{ trans('tradevillage::events.table.village') }}</th>
                                <th>{{ trans('tradevillage::events.table.start_time') }}</th>
                                <th>{{ trans('tradevillage::events.table.end_time') }}</th>
                                <th>{{ trans('tradevillage::events.table.address') }}</th>
                                <th>{{ trans('tradevillage::events.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::events.title.create events') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.events.create') ?>" }
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
