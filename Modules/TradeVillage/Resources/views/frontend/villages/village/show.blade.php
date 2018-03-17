@extends('layouts.master')

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/villageDetail.css') }}">
@stop

@section('content')
    <div class="row village-label content-background">
        <div class="col-md-9 image">
            <div class="village-image">
                <img src="@thumbnail($village->image_village->path, 'largeThumb')" alt="" class="thumbnail"/>
            </div>
            
            <!-- village infomation -->
            <div class="row infomation">
                <h3 class="center"><b>{{ $village->translate(locale())->name }}</b></h3>
                <p>{!! $village->detail !!}</p>
            </div>

            <!-- story -->
            <div class="row">
                <div class="story">
                    <h4><b>{{ trans('tradevillage::villages.table.story') }} {{ $village->translate(locale())->name }}</b></h4>
                    <p>{!! $village->translate(locale())->story !!}</p>
                </div>
                <a href="#" class="show-all pull-right orange-text btn btn-default btn-sm">>>{{ trans('tradevillage::villages.other.viewAll') }}</a>
            </div>
        </div>
        <div class="col-md-3 sidebar">
            <div class="right-side-box">
                <div class="row village-info">
                    <div class="infomation col-xs-6 col-md-12">
                        <a href="#"><h3><b>{{ $village->translate(locale())->name }}</b></h3></a>
                        <a href="#">{{ count($enterprises) }} {{ trans('tradevillage::villages.other.enterprises') }}</a><br>
                        <a href="#">{{ count($collectAll) }} {{ trans('tradevillage::villages.other.products') }}</a><br>
                        <a href="#">{{ count($artists) }} {{ trans('tradevillage::villages.other.artists') }}</a><br>
                        <a href="#">{{ count($news) + count($events)}} {{ trans('tradevillage::villages.other.newsRelative') }}</a><br>
                        <a href="#">{{ $village->visitor_counter }} {{ trans('tradevillage::villages.other.visits') }}</a>
                    </div>
                    <input id="enterprises" name="enterprises" value="{{ $enterprises }}" style="display: none;">
                    <input id="lat" name="lat" style="display: none;">
                    <input id="lng" name="lng" style="display: none;">
                    <input type="text" id="olat" value="{{ $village->lat }}" style="display: none;">
                    <input type="text" id="olng" value="{{ $village->lng }}" style="display: none;">
                    <input type="text" id="id" value="{{ $village->id }}" style="display: none;">
                    <div class="col-md-12 col-xs-6 map-box" id="map" style="width:100%;height: 300px;">
                        
                    </div>
                </div>
                <div class="row top-news">
                    <a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::villages.other.news') }}</b></h4></a>
                    <ul class="new-feed">
                        @if(count($latestNews) > 0)
                            @foreach($latestNews as $latestNew)
                                <li><p class="oneline"><a href="videoDetail.html"><span class="glyphicon glyphicon-list-alt"></span>&emsp;{{ $latestNew->translate(locale())->title }}</a></p>
                                    <p class="timestamp pull-right">{{ $latestNew->created_at }}</p>
                                </li>
                            @endforeach
                        @else
                            <li><p class="oneline"></p>{{ trans('tradevillage::villages.other.messagenews') }}</li>
                        @endif
                    </ul>
                </div>
                <div class="row top-artists">
                    <a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::villages.other.artistFamous') }}</b></h4></a>
                    <ul>
                        @if(count($artists) > 0)
                            @foreach($artists as $artist)
                                <li class="row">
                                    <img src="@thumbnail($artist->feature_image->path, 'largeThumb')" class="img-circle artist img-responsive col-md-3 col-xs-2 thumbnail">
                                    <a href=""><h5>{{ $artist->translate(locale())->name }}</h5></a>
                                    <a href=""><p>{{ $artist->translate(locale())->address }}</p></a>
                                </li>
                            @endforeach
                        @else

                        @endif
                    </ul>
                    <a href="#" class="pull-right orange-text btn btn-default btn-xs">>>{{ trans('tradevillage::villages.other.viewAll') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row relation">
        <div class="col-md-7 col-xs-12 top-product">
            <h4 class="orange-text"><b>{{ trans('tradevillage::villages.other.topProducts') }}</b></h4>
            <div class="row">
                @foreach($collecTopPros as $product)
                    <?php $image_direct = public_path().$product['product']->images ?>
                    <div class="col-md-3 col-xs-6 product">
                        <a href="{{ route('frontend.tradevillage.products.show', [$product['product']->id]) }}"><img src="{{ URL::asset($product['product']->images.scandir($image_direct)[2]) }}" class="img-responsive thumbnail"></a>
                        <div class="overlay">
                            <div class="text">{{ $product['product']->translate(locale())->name }}</div>
                        </div>
                    </div>
                @endforeach
                @if(count($collectAll) > 7)
                    <div class="col-md-3 col-xs-6 product">
                        <a href="#" class="bottom-right orange-text btn btn-default btn-sm">>>{{ trans('tradevillage::villages.other.viewAll') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZMQRL3iYa5SHiluzgTJrHA_otrA52ec&libraries=drawing"></script>
<script type="text/javascript">
    var pathname = window.location.pathname;
    var id = document.getElementById('id').value;
    $.ajax({
        url     : '/tradevillage/abc',
        method  : 'get',
        data    : id,
        success : function(response){
            console.log('abc');
        }
    });
</script>
<script type="text/javascript">
    function initMap() {
        document.getElementById('lat').value = document.getElementById('olat').value;
        document.getElementById('lng').value = document.getElementById('olng').value;
        var lt = document.getElementById('olat').value.split("|");
        var lg = document.getElementById('olng').value.split("|");
        var lat = new Array();
        var lng = new Array();
        var avgLat = 0;
        var avgLng = 0;
        for(var i = 0; i < lt.length-1; i++) {
            lat[i] = parseFloat(lt[i]);
            avgLat += lat[i];
            lng[i] = parseFloat(lg[i]);
            avgLng += lng[i];
        }

        var myLatLng = {lat: avgLat/(lt.length-1), lng: avgLng/(lt.length-1)};

        var map = new google.maps.Map(document.getElementById('map'), {
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







        var request = new XMLHttpRequest();
        request.open('GET', 'http://127.0.0.1:8000/xml/xmltest.xml', true);
        request.send();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var xml = request.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng'))
                    );

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point
                    });
                    marker.addListener('click', function() {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                });
            }
        }





        google.maps.event.addDomListener(window, 'load', initMap);
    }
    initMap();
</script>
@stop