@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::villages.title.villages') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::villages.title.villages') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.villages.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::villages.button.create villages') }}
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
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.name') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.description') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.nov') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.category') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.district') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.province') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.image') }}</th>

                                <th data-sortable="true">{{ trans('tradevillage::villages.table.active_home') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($villages)): ?>
                            <?php foreach ($villages as $villages): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                        {{ $villages->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                        {{ $villages->translate(locale())->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                        {{ $villages->translate(locale())->description }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                        {{ $villages->visitor_counter }}
                                    </a>
                                </td>
                                <td>
                                    @foreach ($categories as $category)
                                        @if($category->village_fields_id == $villages->category_id &&
                                            $category->locale == locale())
                                            <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                            {{ $category->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                
                                <td>
                                    <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                        {{ $villages->district }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}">
                                        {{ $villages->province }}
                                    </a>
                                </td>
                                
                                <td>
                                    <img src="{{ Imagy::getThumbnail($villages->image_village['path'].'', 'smallThumb') }}"/>
                                </td>

                                <td>
                                    <label class="switch">
                                        <input type="checkbox" {{ $villages->active_home? "checked" : "" }} disabled>
                                        <span class="slider round"></span>
                                        <p style="display: none">{{ $villages->active_home }}</p>
                                    </label>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.villages.edit', [$villages->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.villages.destroy', [$villages->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.name') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.description') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.nov') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.category') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.district') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.province') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.image') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::villages.table.active_home') }}</th>
                                <th>{{ trans('tradevillage::villages.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::villages.title.create villages') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.villages.create') ?>" }
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
