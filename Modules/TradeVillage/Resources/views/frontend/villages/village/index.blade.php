@extends('layouts.master')

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tradeVillageIndex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mapDisplay.css') }}">
@stop

@section('content')
    <div class="col-md-12">
        <div class="col-md-6 map map-box-bottom" id="map"></div>
    </div>
    
    <ul class="nav nav-tabs village-category">
        <?php $i = 0 ?>
        @if(isset($categories))
            @foreach($categories as $category)
                <li class="{{ $i==0 ? 'active' : ''}}"><a data-toggle="tab" href="#{{ $categories[$i]->id }}" class="orange-text">{{ $category->translate(locale())->name }}</a></li>
                <?php $i++ ?>
            @endforeach
        @endif
    </ul>
    <div class="tab-content">
        <?php $i = 0 ?>
        @if(isset($categories))
            @foreach($categories as $categories)
                <div id="{{ $categories->id }}" class="tab-pane fade in {{ $i==0 ? 'active' : ''}}">
                    <div class="row">
                        <div class="col-md-6 col-xs-12 introduce">
                            {{ $categories->translate(locale())->description }}
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="row filter">
                                <div class="filter-group">
                                    <button class="filter-item">Tên<span class="glyphicon glyphicon glyphicon-sort"></span></button>
                                    <button class="filter-item">Yêu thích<span class="glyphicon glyphicon glyphicon-sort"></span></button>
                                </div>
                                <div class="filter-group">
                                    <table class="table-responsive">
                                        <tr>
                                            <td><p class="filter-item">Tỉnh/ thành phố</p></td>
                                            <td>
                                                <select class="form-control filter-item">
                                                    <option>Hà Nội</option>
                                                    <option>Hải Phòng</option>
                                                    <option>Nam Định</option>
                                                    <option>Hưng Yên</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row village-list">
                        @foreach($categories->villages as $village)
                            <div class="col-md-6 village">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12"><img src="@thumbnail($village->image_village->path, 'mediumThumb')" class="thumbnail village-spec"/></div>
                                    <div class="col-md-8 col-xs-12">
                                        <h4><a href="{{ route('frontend.tradevillage.villages.show', [$village->id]) }}">{{ $village->translate(locale())->name }}</a></h4>
                                        <p class="twoline">{{ $village->translate(locale())->description }}</p>
                                        <p class="address">
                                            {{ trans('tradevillage::villages.table.address') }} : {{ $village->district }} - {{ $village->province }}
                                        </p>
                                        <p class="visits">{{ $village->visitor_counter }} {{ trans('tradevillage::villages.table.nov') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <?php $i++ ?>
            @endforeach
        @endif
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZMQRL3iYa5SHiluzgTJrHA_otrA52ec&libraries=drawing"></script>
    <script type="text/javascript">
        $('.nav-villages').addClass("active-nav");
        $.ajax({
            url     : '/tradevillage/all-villages',
            method  : 'get',
            success : function(response){
                //display map of VietNam
                var vietnam = {lat: 16.294378, lng: 107.674525};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 5.2,
                    center: vietnam
                });
                
                //display all of Villages on map
                for(var k = 0; k < response.length; k++) {
                    var lt = response[k]['lat'].split("|");
                    var lg = response[k]['lng'].split("|");
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

                    var infowindow = new google.maps.InfoWindow({maxWidth: 350, maxHeight: 300});
                    var infowincontent = 
                    '<div id="iw-container">' + 
                        '<div class="iw-title">Village name</div>' +
                        '<div class="col-md-12">' + 
                            '<div class="col-md-3">' + 
                                '<img class="img-village" src="http://maps.marnoto.com/en/5wayscustomizeinfowindow/images/vistalegre.jpg" alt="Porcelain Factory of Vista Alegre" height="90" width="90">' + 
                            '</div>' + 
                            '<div class="col-md-1"></div>' + 
                            '<div class="col-md-6">' + 
                                '<h5 class="village-name">' + 'Village name' + '</h5>' + 
                                '<div class="village-address">' + 
                                    '<img src="/images/marker1.jpg" width="15">' + 
                                    'sfasff' + 
                                    '<p class="forline">ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia</p>' +
                                '</div>' + 
                            '</div>' + 
                        '</div>' + 
                        '<div class="col-md-12">' + 
                        '</div>' + 
                        '<div class="col-md-12">' + 
                            '<ul class="ul-info">' + 
                                '<li class="li-info"><a class="a-info" href="#"><img src="/images/view1.png" width="15"> Views</a></li>' + 
                                '<li class="li-info"><a class="a-info" href="#"><img src="/images/category.png" width="15"> Category</a></li>' + 
                                '<li class="li-info"><a class="a-info" href="#"><img src="/images/products.png" width="15"> Products</a></li>' + 
                            '</ul>' + 
                        '</div>' + 
                        '<div class="col-md-12">' +
                            '<h5>'+ 'Enterprise' +'</h5>' + 
                        '</div>'
                    '</div>';
                    google.maps.event.addListener(marker,'click', (function(marker,infowincontent,infowindow){ 
                        return function() {
                            infowindow.setContent(infowincontent);
                            infowindow.open(map,marker);
                        };
                    })(marker,infowincontent,infowindow));  
                }
            }
        });
    </script>
@stop
