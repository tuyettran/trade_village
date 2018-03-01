@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::village_coordinates.title.village_coordinates') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('tradevillage::village_coordinates.title.village_coordinates') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tradevillage.village_coordinates.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('tradevillage::village_coordinates.button.create village_coordinates') }}
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
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.village') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.map') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($village_coordinates)): ?>
                            <?php foreach ($village_coordinates as $village_coordinates): ?>
                            <input type="text" id="lat" value="{{ $village_coordinates->lat }}" style="display: none;">
                            <input type="text" id="lng" value="{{ $village_coordinates->lng }}" style="display: none;">
                            <input type="text" id="idNo" value="{{ $village_coordinates->id }}" style="display: none;">
                            <tr>
                                <td>
                                    <a href="{{ route('admin.tradevillage.village_coordinates.edit', [$village_coordinates->id]) }}">
                                        {{ $village_coordinates->id }}
                                    </a>
                                </td>
                                <td>
                                    @foreach($villages as $village)
                                        @if($village->villages_id == $village_coordinates->village_id && $village->locale == locale())
                                            <a href="{{ route('admin.tradevillage.village_coordinates.edit', [$village_coordinates->id]) }}">
                                                {{ $village->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="col-md-12" id="map{{$village_coordinates->id}}" style="width:100%;height: 200px;"></div>

                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tradevillage.village_coordinates.edit', [$village_coordinates->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tradevillage.village_coordinates.destroy', [$village_coordinates->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.no') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.village') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.map') }}</th>
                                <th data-sortable="true">{{ trans('tradevillage::village_coordinates.table.actions') }}</th>
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
        <dd>{{ trans('tradevillage::village_coordinates.title.create village_coordinates') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZMQRL3iYa5SHiluzgTJrHA_otrA52ec&libraries=drawing&callback=initMap" async defer></script>
    <script type="text/javascript">
        function initMap() {
            var id = document.getElementById('idNo').value;
            var idMap = 'map' + id; 
            var lt = document.getElementById('lat').value.split("|");
            var lg = document.getElementById('lng').value.split("|");
            var lat = new Array();
            var lng = new Array();
            for(var i = 0; i < lt.length-1; i++) {
                lat[i] = parseFloat(lt[i]);
                lng[i] = parseFloat(lg[i]);
            }

            var myLatLng = {lat: 21.027764, lng: 105.834160};

            var map = new google.maps.Map(document.getElementById(idMap), {
                zoom: 16,
                center: myLatLng
            });
            
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });

            var polygonCoords  = [];
            for(var i = 0; i < lat.length; i++) { 
                polygonCoords.push(new google.maps.LatLng(lat[i],lng[i]));
            }

            var polygon = new google.maps.Polygon({
                paths: polygonCoords,
                strokeColor: 'black',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#505256',
                fillOpacity: 0.4
            });

            polygon.setMap(map);
        }
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tradevillage.village_coordinates.create') ?>" }
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
