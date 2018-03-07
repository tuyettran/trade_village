@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::product_comments.title.product_comments') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::product_comments.title.product_comments') }}</li>
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
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.content') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.user') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.product') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($product_comments)): ?>
                            <?php foreach ($product_comments as $product_comments): ?>
                            <tr>
                                <td>
                                    {{ $product_comments->id }}
                                </td>
                                <td>
                                    {{ $product_comments->content }}
                                </td>
                                <td>
                                    @foreach($users as $user)
                                        @if($user->id == $product_comments->user_id)
                                            {{ $user->first_name }}
                                            {{ $user->last_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($products as $product)
                                        @if($product->products_id == $product_comments->product_id && $product->locale == locale())
                                            {{ $product->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.product_comments.destroy', [$product_comments->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.content') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.user') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.product') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::product_comments.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::product_comments.title.create product_comments') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.product_comments.create') ?>" }
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
