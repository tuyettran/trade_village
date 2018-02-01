@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::documents.title.documents') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::documents.title.documents') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.documents.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::documents.button.create documents') }}
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
                                <th>{{ trans('tradevillage::documents.table.title') }}</th>
                                <th>{{ trans('tradevillage::documents.table.course_name') }}</th>
                                <th>{{ trans('tradevillage::documents.table.author') }}</th>
                                <th>{{ trans('tradevillage::documents.table.chapter') }}</th>
                                <th data-sortable="false">{{ trans('tradevillage::documents.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($documents)): ?>
                            <?php foreach ($documents as $document): ?>
                            <tr>
                                <td>{{ $document->id }}</td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.documents.edit', [$document->id]) }}">
                                        {{ $document->translate(locale())->title }}
                                    </a>
                                </td>
                                <td>
                                    @if( isset($courses))
                                        @foreach($courses as $course)
                                            @if( $course->courses_id == $document->course_id && $course->locale == locale())
                                                <a href="{{ route('admin.tradevillage.documents.edit', [$document->id]) }}">
                                                    {{ $course->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.documents.edit', [$document->id]) }}">
                                        {{ $document->translate(locale())->author }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.documents.edit', [$document->id]) }}">
                                        {{ $document->chapter }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.documents.edit', [$document->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.documents.destroy', [$document->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('tradevillage::documents.table.title') }}</th>
                                <th>{{ trans('tradevillage::documents.table.course_name') }}</th>
                                <th>{{ trans('tradevillage::documents.table.author') }}</th>
                                <th>{{ trans('tradevillage::documents.table.chapter') }}</th>
                                <th data-sortable="false">{{ trans('tradevillage::documents.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::documents.title.create documents') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.documents.create') ?>" }
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
