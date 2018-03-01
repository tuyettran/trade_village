@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::village_coordinates.title.create village_coordinates') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.village_coordinates.index') }}">{{ trans('tradevillage::village_coordinates.title.village_coordinates') }}</a></li>
        <li class="active">{{ trans('tradevillage::village_coordinates.title.create village_coordinates') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.village_coordinates.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.village_coordinates.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        {!! Form::label("map", trans("tradevillage::village_coordinates.form.map")) !!}
                        <input id="savebutton" type="button" value="Save">
                        <input id="lat" name="lat" style="display: none;">
                        <input id="lng" name="lng" style="display: none;">
                        <!-- <textarea id="savedata" rows="5" cols="70"></textarea> -->
                        <input id="cancelbutton" type="button" value="Cancel">
                        <div class="col-md-12" id="map" style="width:100%;height: 500px;"></div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.village_coordinates.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZMQRL3iYa5SHiluzgTJrHA_otrA52ec&libraries=drawing"></script>
    <script type="text/javascript">
        function initMap() {
            var myLatLng = {lat: 21.027764, lng: 105.834160};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: myLatLng
            });
            
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });

            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.MARKER,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon']
                },
            });
            drawingManager.setMap(map);

            var polygons = [];

            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
                polygons.push(polygon);
            });

            google.maps.event.addDomListener(savebutton, 'click', function() {
                var lat = "";
                var lng = "";
                for (var i = 0; i < polygons.length; i++) {
                    var polygonBounds = polygons[i].getPath();
                    for (var j = 0; j < polygonBounds.length; j++)
                    {
                        lat += polygonBounds.getAt(j).lat() + "|";
                        lng += polygonBounds.getAt(j).lng() + "|";
                    }
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                }
            });

            google.maps.event.addDomListener(cancelbutton, 'click', function() {
                var myLatLng = {lat: 21.027764, lng: 105.834160};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: myLatLng
            });
            
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });

            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.MARKER,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon']
                },
            });
            drawingManager.setMap(map);

            var polygons = [];

            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
                polygons.push(polygon);
            });

            google.maps.event.addDomListener(savebutton, 'click', function() {
                var lat = "";
                var lng = "";
                for (var i = 0; i < polygons.length; i++) {
                    var polygonBounds = polygons[i].getPath();
                    for (var j = 0; j < polygonBounds.length; j++)
                    {
                        lat += polygonBounds.getAt(j).lat() + "|";
                        lng += polygonBounds.getAt(j).lng() + "|";
                    }
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                }
            });
            });
            google.maps.event.addDomListener(window, 'load', initMap);
        }
        initMap();
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.tradevillage.village_coordinates.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
