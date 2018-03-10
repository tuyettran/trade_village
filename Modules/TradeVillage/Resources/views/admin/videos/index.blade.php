@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::videos.title.videos') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::videos.title.videos') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-grou,p pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.video.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::videos.button.create video') }}
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
                                <th data-sortable="true">No</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.name') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.lesson_id') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.chapter') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.author') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.link') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($videos)): ?>
                            <?php foreach ($videos as $video): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.video.edit', [$video->id]) }}">
                                        {{ $video->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.video.edit', [$video->id]) }}">
                                        {{ $video->translate(locale())->name }}
                                    </a>
                                </td>
                                <td>
                                    @if( isset($lessons))
                                        @foreach($lessons as $lessons)
                                            @if( $lessons->lessons_id == $video->lesson_id && $lessons->locale == locale())
                                                <a href="{{ route('admin.tradevillage.documents.edit', [$video->id]) }}">
                                                    {{ $lessons->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.video.edit', [$video->id]) }}">
                                        {{ $video->chapter }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.video.edit', [$video->id]) }}">
                                        {{ $video->translate(locale())->author }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.video.edit', [$video->id]) }}">
                                        {{ $video->link }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.video.edit', [$video->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.video.destroy', [$video->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th data-sortable="true">No</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.name') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.lesson_id') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.chapter') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.author') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.link') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::videos.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::videos.title.create video') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.video.create') ?>" }
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
