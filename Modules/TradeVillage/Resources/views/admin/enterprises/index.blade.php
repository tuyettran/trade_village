@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::enterprises.title.enterprises') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::enterprises.title.enterprises') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.enterprises.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::enterprises.button.create enterprises') }}
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
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.name') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.description') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.address') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.village') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.user') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.image') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.website') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.contact') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($enterprises)): ?>
                            <?php foreach ($enterprises as $enterprises): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                        {{ $enterprises->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                        {{ $enterprises->translate(locale())->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                        {{ $enterprises->translate(locale())->description }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                        {{ $enterprises->translate(locale())->address }}
                                    </a>
                                </td>
                                <td>
                                    @foreach($villages as $village)
                                        @if($village->villages_id == $enterprises->village_id && $village->locale == locale())
                                            <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                                {{ $village->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($users as $user)
                                        @if($user->id == $enterprises->user_id)
                                            <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                                {{ $user->first_name }}
                                                {{ $user->last_name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <img src="{{ Imagy::getThumbnail($enterprises->feature_image['path'].'', 'smallThumb') }}"/>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                        {{ $enterprises->website }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}">
                                        {{ $enterprises->contact }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.enterprises.edit', [$enterprises->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.enterprises.destroy', [$enterprises->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.name') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.description') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.address') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.village') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.user') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.image') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.website') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.contact') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::enterprises.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::enterprises.title.create enterprises') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.enterprises.create') ?>" }
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
