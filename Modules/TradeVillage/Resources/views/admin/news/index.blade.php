@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::news.title.news') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::news.title.news') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.news.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::news.button.create news') }}
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
                                <th data-sortable="true">{{ trans('tradevillage::news.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.title') }}</th>
                                
                                <th data-sortable="true">{{ trans('tradevillage::news.table.image') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.village') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($news)): ?>
                            <?php foreach ($news as $news): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.news.edit', [$news->id]) }}">
                                        {{ $news->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.news.edit', [$news->id]) }}">
                                        {{ $news->translate(locale())->title }}
                                    </a>
                                </td>
                                <td>
                                    <img src="{{ Imagy::getThumbnail($news->feature_image['path'].'', 'smallThumb') }}"/>
                                </td>
                                <td>
                                    @foreach ($villages as $village)
                                        @if($village->villages_id == $news->village_id &&
                                            $village->locale == locale())
                                            <a href="{{ route('admin.tradevillage.news.edit', [$news->id]) }}">
                                            {{ $village->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.news.edit', [$news->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.news.destroy', [$news->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.title') }}</th>
                                
                                <th data-sortable="true">{{ trans('tradevillage::news.table.image') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.village') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::news.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::news.title.create news') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.news.create') ?>" }
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
