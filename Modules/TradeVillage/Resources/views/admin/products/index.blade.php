@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::products.title.products') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::products.title.products') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.products.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::products.button.create products') }}
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
                                <th>{{ trans('tradevillage::products.table.name') }}</th>
                                <th>{{ trans('tradevillage::products.table.description') }}</th>
                                <th>{{ trans('tradevillage::products.table.cost') }}</th>
                                <th>{{ trans('tradevillage::products.table.material') }}</th>
                                <th>{{ trans('tradevillage::products.table.owner') }}</th>
                                <th data-sortable="false">{{ trans('tradevillage::products.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($products)): ?>
                            <?php foreach ($products as $products): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                        {{ $products->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                        {{ ($products->translate(locale())) ? $products->translate(locale())->name : "" }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                        {{ ($products->translate(locale())) ? $products->translate(locale())->description : "" }}
                                    </a>
                                </td>
                                <td>
                                <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                        {{ $products->cost }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                        {{ ($products->translate(locale())) ? $products->translate(locale())->material : "" }}
                                    </a>
                                </td>
                                <td>
                                    @if( $products->enterprise_id != null)
                                        @foreach( $enterprises as $enterprise)
                                            @if( $enterprise->enterprises_id == $products->enterprise_id && $enterprise->locale == locale())
                                                <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                                    {{ $enterprise->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @elseif( $products->artist_id != null)
                                        @foreach( $artists as $artist)
                                            @if( $artist->artist_id == $products->artist_id && $artist->locale == locale())
                                                <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}">
                                                    {{ $artist->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.products.edit', [$products->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.products.destroy', [$products->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('tradevillage::products.table.name') }}</th>
                                <th>{{ trans('tradevillage::products.table.description') }}</th>
                                <th>{{ trans('tradevillage::products.table.cost') }}</th>
                                <th>{{ trans('tradevillage::products.table.material') }}</th>
                                <th>{{ trans('tradevillage::products.table.owner') }}</th>
                                <th>{{ trans('tradevillage::products.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::products.title.create products') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.products.create') ?>" }
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
