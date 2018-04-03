@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::villages.title.edit villages') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.villages.index') }}">{{ trans('tradevillage::villages.title.villages') }}</a></li>
        <li class="active">{{ trans('tradevillage::villages.title.edit villages') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.villages.update', $villages->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.villages.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        <div class="form-group{{ $errors->has("category_id") ? " has-error" : "" }}">
                            {!! Form::label("category_id", trans("tradevillage::villages.form.category")) !!} 
                                <select name="category_id">
                                    @if( isset($categories))
                                    @foreach( $categories as $category)
                                        @if( $category->locale == locale())
                                            @if( $category->village_fields_id == $villages->category_id)
                                                <option value={{$category->village_fields_id}} selected>{{$category->name}}</option>
                                            @else
                                                <option value={{$category->village_fields_id}}>{{$category->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                    @endif
                                </select>
                            {!! $errors->first("category_id", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("province") ? " has-error" : "" }}">
                            {!! Form::label("province", trans("tradevillage::villages.form.province")) !!} 
                                <select name="province" id="province">
                                    
                                </select>
                            {!! $errors->first("province", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("district") ? " has-error" : "" }}">
                            {!! Form::label("district", trans("tradevillage::villages.form.district")) !!} 
                                <select name="district" id="district"> 
                                    
                                </select>
                            {!! $errors->first("district", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("visitor_counter") ? " has-error" : "" }}">
                            {!! Form::label("visitor_counter", trans("tradevillage::villages.form.visitor_counter")) !!}
                            
                            {!! Form::number("visitor_counter", old("visitor_counter", $villages->visitor_counter), ["class" => "form-control", "placeholder" => trans("tradevillage::villages.form.visitor_counter")]) !!}
                            
                            {!! $errors->first("visitor_counter", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("active_home") ? " has-error" : "" }}">
                            {!! Form::label("active_home", trans("tradevillage::villages.form.active_home")) !!}
                            <br> 
                            <label class="switch">
                                <input name="active_home" type="checkbox" {{ $villages->active_home? "checked" : "" }}>
                                <span class="slider round"></span>
                            </label>
                            {!! $errors->first("active_home", '<span class="help-block">:message</span>') !!}
                        </div>
                        
                        @mediaSingle('image_village',$villages)

                        {!! Form::label("map", trans("tradevillage::villages.form.map")) !!}
                        <input type="text" id="olat" value="{{ $villages->lat }}" style="display: none;">
                        <input type="text" id="olng" value="{{ $villages->lng }}" style="display: none;">
                        <input id="savebutton" type="button" value="Save">
                        <input id="lat" name="lat" style="display: none;">
                        <input id="lng" name="lng" style="display: none;">
                        <input id="cancelbutton" type="button" value="Edit">
                        <div class="col-md-12" id="map" style="width:100%;height: 500px;"></div>
                    </div>
                    <input type="text" id="oprovince" value="{{ $villages->province }}" style="display: none;">
                    <input type="text" id="odistrict" value="{{ $villages->district }}" style="display: none;">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.villages.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                zoom: 18,
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

            google.maps.event.addDomListener(cancelbutton, 'click', function() {
                document.getElementById('lat').value = "";
                document.getElementById('lng').value = "";
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
                    { key: 'b', route: "<?= route('admin.tradevillage.villages.index') ?>" }
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
    <script type="text/javascript">
        $( document ).ready(function() {
            var province_arr = new Array("An Giang", "Bắc Giang", "Bắc Kạn", "Bạc Liêu", "Bắc Ninh", "Bà Rịa - Vũng Tàu", "Bến Tre", "Bình Định", "Bình Dương", "Bình Phước", "Bình Thuận", "Cà Mau", "Cao Bằng", "Đắk Lắk", "Đắc Nông", "Đà Nẵng", "Điện Biên", "Đồng Nai", "Đồng Tháp", "Gia Lai", "Hà Giang", "Hải Dương", "Hải Phòng", "Hà Nam", "Hà Nội", "Hà Tĩnh", "Hậu Giang","Hòa Bình", "Hưng Yên", "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu", "Lâm Đồng", "Lạng Sơn", "Lào Cai", "Long An", "Nam Định", "Nghệ An", "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Phú Yên", "Quảng Bình", "Quảng Nam", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị", "Sóc Trăng", "Sơn La", "Tây Ninh", "Thái Bình", "Thái Nguyên", "Thanh Hóa", "Cần Thơ", "TP.Hồ Chí Minh", "Thừa Thiên - Huế", "Tiền Giang", "Trà Vinh", "Tuyên Quang", "Vĩnh Long", "Vĩnh Phúc", "Yên Bái");

            var district_a = new Array();
            district_a[0] = "";
            district_a[1] = "Long Xuyên|Châu Đốc|An Phú|Tân Châu|Phú Tân|Châu Phú|Tịnh Biên|Tri Tôn|Châu Thành|Chợ Mới|Thoại Sơn";
            district_a[2] = "Thành phố Bắc Giang|Yên Thế|Tân Yên|Lạng Giang|Lục Nam|Lục Ngạn|Sơn Động|Yên Dũng|Việt Yên|Hiệp Hòa";
            district_a[3] = "Thành phố Bắc Kạn|Pác Nặm|Ba Bể|Ngân Sơn|Bạch Thông|Chợ Đồn|Chợ Mới|Thoại";
            district_a[4] = "Thành phố Bạc Liêu|Hồng Dân|Phước Long|Vĩnh Lợi|Giá Rai|Đông Hải|Hòa Bình";
            district_a[5] = "Thành phố Bắc Ninh|Yên Phong|Quế Võ|Tiên Du|Từ Sơn|Thuận Thành|Gia Bình|Lương Tài";
            district_a[6] = "Thành phố Vũng Tàu|Thành phố Bà Rịa|Châu Đức|Xuyên Mộc|Long Điền|Đất Đỏ|Tân Thành|Côn Đảo";
            district_a[7] = "Thành phố Bến Tre|Châu Thành|Chợ Lách|Mỏ Cày Nam|Giồng Trôm|Bình Đại|Ba Tri|Thạch Phú|Mỏ Cày Bắc";
            district_a[8] = "Thành phố Quy Nhơn|An Lão|Hoài Nhơn|Hoài Ân|Phù Mỹ|Vĩnh Thạnh|Tây Sơn|Phù Cát|An Nhơn|Tuy Phước|Vân Canh";
            district_a[9] = "Thành phố Thủ Dầu Một|Bàu Bàng|Dầu Tiếng|Bến Cát|Phú Giáo|Tân Uyên|Dĩ An|Thuận An|Bắc Tân Uyên";
            district_a[10] = "Thị xã Phước Long|Thị xã Đồng Xoài|Thị xã Bình Long|Bù Gia Mập|Lộc Linh|Bù Đốp|Hớn Quản|Đồng Phú|Bù Đăng|Chơn Thành|Phú Riềng";
            district_a[11] = "Thành phố Phan Thiết|Thị xã La Gi|Tuy Phong|Bắc Bình|Hàm Thuận Bắc|Hàm Thuận Nam|Tánh Ninh|Đức Linh|Hàm Tân|Phú Quí";
            district_a[12] = "Thành phố Cà Mau|U Minh|Thới Bình|Trần Văn Thời|Cái Nước|Đầm Dơi|Năm Căn|Phú Tân|Ngọc Hiển";
            district_a[13] = "Thành phố Cao Bằng|Bảo Lâm|Bảo Lạc|Thông Nông|Hà Quảng|Trà Lĩnh|Trùng Khánh|Hạ Lang|Quảng Uyên|Phục Hòa|Hòa An|Nguyên Bình|Thạch An";
            district_a[14] = "Thành phố Buôn Ma Thuột|Thị xã Buôn Hồ|Ea H'leo|Ea Súp|Buôn Đôn|Cư M'gar|Krông Búk|Krông Năng|Ea Kar|M'Đrắk|Krông Bông|Krông Pắc|Krông A Na|Huyện Lắk|Cư Kuin";
            district_a[15] = "Thị xã Gia Nghĩa|Đăk Glong|Cư Jút|Đăk Mil|Krông Nô|Đắk Song|Đắk R'Lấp|Tuy Đức";
            district_a[16] = "Quận Liên Chiểu|Quận Thanh Khê|Quận Hải Châu|Sơn Trà|Ngũ Hành Sơn|Cẩm Lệ|Hòa Vang|Hoàng Sa";
            district_a[17] = "Thành phố Điện Biên Phủ|Thị xã Mường Lay|Mường Nhé|Mường Chà|Tủa Chùa|Tuần Giáo|Điện Biên|Điện Biên Đông|Mường Áng|Nậm Pồ";
            district_a[18] = "Thành phố Biên Hòa|Long Khánh|Tân Phú|Vĩnh Cửu|Định Quán|Trảng Bom|Thống Nhất|Cẩm Mỹ|Long Thành|Xuân Lộc|Nhơn Trạch";
            district_a[19] = "Thành phố Cao Lãnh|Thành phố Sa Đéc|Thị xã Hồng Ngự|Tân Hồng|Huyện Hồng Ngự|Tam Nông|Tháp Mười|Cao Lãnh|Thanh Bình|Lấp Vò|Lai Vung|Châu Thành";
            district_a[20] = "Thành phố Pleiku|Thị xã An Khê|Thị xã Ayun Pa|KBang|Đăk Đoa|Chư Păh|Ia Grai|Mang Yang|Kông Chro|Đức Cơ|Chư Prông|Chư Sê|Đăk Pơ|Ia Pa|Krông Pa|Phú Thiện|Chư Pưh";
            district_a[21] = "Thành phố Hà Giang|Đồng Văn|Mèo Vạc|Yên Minh|Quản Bạ|Vị Xuyên|Bắc Mê|Hoàng Su Phì|Xín Mần|Bắc Quang|Quang Bình";
            district_a[22] = "Thành phố Hải Dương|Thị xã Chí Linh|Nam Sách|Kinh Môn|Kim Thành|Thanh Hà|Cẩm Giàng|Bình Giang|Gia Lộc|Tứ Kỳ|Ninh Giang|Thanh Miện";
            district_a[23] = "Quận Hồng Bàng|Quận Ngô Quyền|Quận Lê Chân|Quận Hải An|Quận Kiến An|Quận Đồ Sơn|Quận Dương Kinh|Thủy Nguyên|An Dương|An Lão|Kiến Thụy|Tiên Lãng|Vĩnh Bảo|Cát Hải|Bạch Long Vĩ";
            district_a[24] = "Thành phố Phủ Lý|Duy Tiên|Kim Bảng|Thanh Liêm|Bình Lục|Lý Nhân";
            district_a[25] = "Quận Ba Đình|Quận Hoàn Kiếm|Quận Tây Hồ|Quận Long Biên|Quận Cầu Giấy|Quận Đống Đa|Quận Hai Bà Trưng|Quận Hoàng Mai|Quận Thanh Xuân|Sóc Sơn|Đông Anh|Gia Lâm|Quận Nam Từ Liêm|Quận Bắc Từ Liêm|Thanh Trì|Mê Linh|Quận Hà Đông|Thị xã Sơn Tây|Ba Vì|Phúc Thọ|Đan Phượng|Hoài Đức|Quốc Oai|Thạch Thất|Chương Mỹ|Thanh Oai|Thường Tín|Phú Xuyên|Ứng Hòa|Mỹ Đức";
            district_a[26] = "Thành phố Hà Tĩnh|Thị xã Hồng Lĩnh|Hương Sơn|Đức Thọ|Vũ Quang|Nghi Xuân|Can Lộc|Hương Khê|Thạch Hà|Cẩm Xuyên|Kỳ Anh|Lộc Hà|Thị xã Kỳ Anh|Gia";
            district_a[27] = "Thành phố Vị Thanh|Thị xã Ngã Bảy|Châu Thành A|Châu Thành|Phụng Hiệp|Vị Thuỷ|Long Mỹ|Thị xã Long Mỹ";
            district_a[28] = "Thành phố Hòa Bình|Đà Bắc|Kỳ Sơn|Lương Sơn|Kim Bôi|Cao Phong|Tân Lạc|Mai Châu|Lạc Sơn|Yên Thủy|Lạc Thủy";
            district_a[29] = "Thành phố Hưng Yên|Văn Lâm|Văn Giang|Yên Mỹ|Mỹ Hào|Ân Thi|Khoái Châu|Kim Động|Tiên Lữ|Phù Cừ";
            district_a[30] = "Thành phố Nha Trang|Thành phố Cam Ranh|Cam Lâm|Vạn Ninh|Thị xã Ninh Hòa|Khánh Vĩnh|Diên Khánh|Khánh Sơn|Trường Sa";
            district_a[31] = "Thành phố Rạch Giá|Thị xã Hà Tiên|Kiên Lương|Hòn Đất|Tân Hiệp|Châu Thành|Giồng Riềng|Gò Quao|An Biên|An Minh|Vĩnh Thuận|Phú Quốc|Kiên Hải|U Minh Thượng|Giang Thành";
            district_a[32] = "Thành phố Kon Tum|Đắk Glei|Ngọc Hồi|Đắk Tô|Kon Plông|Kon Rẫy|Đắk Hà|Sa Thầy|Tu Mơ Rông|Ia H'Drai";
            district_a[33] = "Thành Phố Lai Châu|Tam Đường|Mường Tè|Sìn Hồ|Phong Thổ|Than Uyên|Tân Uyên|Nậm Nhùn";
            district_a[34] = "Thành phố Đà Lạt|Thành phố Bảo Lộc|Đam Rông|Lạc Dương|Lâm Hà|Đơn Dương|Đức Trọng|Di Linh|Bảo Lâm|Đạ Huoai|Đạ Tẻh|Cát Tiên";
            district_a[35] = "Thành phố Lạng Sơn|Tràng Định|Bình Gia|Văn Lãng|Cao Lộc|Văn Quan|Bắc Sơn|Hữu Lũng|Chi Lăng|Lộc Bình|Đình Lập";
            district_a[36] = "Thành phố Lào Cai|Bát Xát|Mường Khương|Si Ma Cai|Bắc Hà|Bảo Thắng|Bảo Yên|Sa Pa|Văn Bàn";
            district_a[37] = "Thành phố Tân An|Thị xã Kiến Tường|Tân Hưng|Vĩnh Hưng|Mộc Hóa|Tân Thạnh|Thạnh Hóa|Đức Huệ|Đức Hòa|Bến Lức|Thủ Thừa|Tân Trụ|Cần Đước|Cần Giuộc|Châu Thành";
            district_a[38] = "Thành phố Nam Định|Mỹ Lộc|Vụ Bản|Ý Yên|Nghĩa Hưng|Nam Trực|Trực Ninh|Xuân Trường|Giao Thủy|Hải Hậu";
            district_a[39] = "Thành phố Vinh|Thị xã Cửa Lò|Thị xã Thái Hòa|Quế Phong|Quỳ Châu|Kỳ Sơn|Tương Dương|Nghĩa Đàn|Quỳ Hợp|Quỳnh Lưu|Con Cuông|Tân Kỳ|Anh Sơn|Diễn Châu|Yên Thành|Đô Lương|Thanh Chương|Nghi Lộc|Nam Đàn|Hưng Nguyên|Thị xã Hoàng Mai";
            district_a[40] = "Thành phố Ninh Bình|Thành phố Tam Điệp|Nho Quan|Gia Viễn|Hoa Lư|Yên Khánh|Kim Sơn";
            district_a[41] = "Thành phố Phan Rang-Tháp Chàm|Bác Ái|Ninh Sơn|Ninh Hải|Ninh Phước|Thuận Bắc|Thuận Nam";
            district_a[42] = "Thành phố Việt Trì|Thị xã Phú Thọ|Đoan Hùng|Hạ Hòa|Thanh Ba|Phù Ninh|Yên Lập|Cẩm Khê|Tam Nông|Lâm Thao|Thanh Sơn||Thanh Thủy|Tân Sơn";
            district_a[43] = "Thành phố Tuy Hòa|Thị xã Sông Cầu|Đồng Xuân|Tuy An|Sơn Hòa|Sông Hinh|Tây Hòa|Phú Hòa|Đông Hòa";
            district_a[44] = "Thành phố Đồng Hới|Minh Hóa|Tuyên Hóa|Quảng Trạch|Bố Trạch|Quảng Ninh|Lệ Thủy|Thị xã Ba Đồng";
            district_a[45] = "Thành phố Tam Kỳ|Thành phố Hội An|Tây Giang|Đông Giang|Đại Lộc|Điện Bàn|Duy Xuyên|Quế Sơn|Nam Giang|Phước Sơn|Hiệp Đức|Thăng Bình|Tiên Phước|Bắc Trà My|Nam Trà My|Núi Thành|Phú Ninh|Nông Sơn";
            district_a[46] = "Thành phố Quảng Ngãi|Bình Sơn|Trà Bồng|Tây Trà|Sơn Tịnh|Tư Nghĩa|Sơn Hà|Sơn Tây|Minh Long|Nghĩa Hành|Mộ Đức|Đức Phổ|Ba Tơ|Lý Sơn";
            district_a[47] = "Thành phố Hạ Long|Thành phố Móng Cái|Thành phố Cẩm Phả|Thành phố Uông Bí|Bình Liêu|Tiên Yên|Đầm Hà|Hải Hà|Ba Chẽ|Vân Đồn|Hoành Bồ|Thị xã Đông Triều|Thị xã Quảng Yên|Cô Tô";
            district_a[48] = "Thành phố Đônh Hà|Thị xã Quảng Trị|Vĩnh Linh|Hướng Hóa|Gio Linh|Đa Krông|Cam Lộ|Triệu Phong|Hải Lăng|Cồn Cỏ";
            district_a[49] = "Thành phố Sóc Trăng|Châu Thành|Kế Sách|Mỹ Tú|Cù Lao Dung|Long Phú||Mỹ Xuyên|Thị xã Ngã Năm|Thạnh Trị|Thị xã Vĩnh Châu|Trần Đề";
            district_a[50] = "Thành phố Sơn La|Quỳnh Nhai|Thuận Châu|Mường La|Bắc Yên|Phù Yên|Mộc Châu|Yên Châu|Mai Sơn|Sông Mã|Sốp Cộp|Vân Hồ";
            district_a[51] = "Thành phố Tây Ninh|Tân Biên|Tân Châu|Dương Minh Châu|Châu Thành|Hòa Thành|Gò Dầu|Bến Cầu|Trảng Bàng";
            district_a[52] = "Thành phố Thái Bình|Quỳnh Phụ|Hưng Hà|Đông Hưng|Thái Thụy|Tiền Hải|Kiến Xương|Vũ Thường";
            district_a[53] = "Thành phố Thái Nguyên|Thành phố Sông Công|Định Hóa|Phú Lương|Đồng Hỷ|Võ Nhai|Đại Từ|Thị xã Phổ Yên|Phú Bình";
            district_a[54] = "Thành phố Thanh Hóa|Thị xã Bỉm Sơn|Thành phố Sầm Sơn|Mường Lát|Quan Hóa|Bá Thước|Quan Sơn|Lang Chánh|Ngọc Lặc|Cẩm Thủy|Thạch Thành|Hà Trung|Vĩnh Lộc|Yên Định|Thọ Xuân|Thường Xuân|Triệu Sơn|Thiệu Hóa|Hoằng Hóa|Hậu Lộc|Nga Sơn|Như Xuân|Như Thanh|Nông Cống|Đông Sơn|Quảng Xương|Tĩnh Gia";
            district_a[55] = "Quận Ninh Kiều|Quận Ô Môn|Quận Bình Thủy|Quận Cái Răng|Quận Thốt Nốt|Vĩnh Thạnh|Cờ Đỏ|Phong Điền|Thới Lai";
            district_a[56] = "Quận 1|Quận 12|Quận Thủ Đức|Quận 9|Quận Gò Vấp|Quận Bình Thạnh|Tân Bình|Tân Phú|Phú Nhuận|Quận 2|Quận 3|Quận 4|Quận 5|Quận 10|Quận 11|Quận 6|Quận 8|Quận Bình Tân|Quận 7|Củ Chi|Hóc Môn|Bình Chánh|Nhà Bè|Cần Giờ";
            district_a[57] = "Thành phố Huế|Phong Điền|Quảng Điền|Phú Vang|Thị xã Hương Thủy|Thị xã Hương Trà|A Lưới|Phú Lộc|Nam Đông";
            district_a[58] = "Thành phố Mỹ Tho|Thị xã Gò Công|Thị xã Cai Lậy|Tân Phước|Cái Bè|Cai Lậy|Châu Thành|Chợ Gạo|Gò Công Tây|Gò Công Đông|Tân Phú Đông";
            district_a[59] = "Thành phố Trà Vinh|Càng Long|Cầu Kè|Tiểu Cần|Châu Thành|Cầu Ngang|Trà Cú|Duyên Hải|Thị xã Duyên Hải";
            district_a[60] = "Thành phố Tuyên Quang|Lâm Bình|Nà Hang|Chiêm Hóa|Hàm Yên|Yên Sơn|Sơn Dương";
            district_a[61] = "Thành phố Vĩnh Long|Long Hồ|Mang Thít|Vũng Liêm|Tam Bình|Thị xã Bình Minh|Trà Ôn|Bình Tân";
            district_a[62] = "Thành phố Vĩnh Yên|Thị xã Phúc Yên|Lập Thạch|Tam Dương|Tam Đảo|Bình Xuyên|Yên Lạc|Vĩnh Tường|Sông Lô";
            district_a[63] = "Thành phố Yên Bái|Thị xã Nghĩa Lộ|Lục  Yên|Văn Yên|Mù Căng Chải|Trấn Yên|Trạm Tấu|Văn Chấn|Yên Bình";


            function district( provinceElementId, districtElementId ){              
                var selectedProvinceIndex = document.getElementById( provinceElementId ).selectedIndex;
                var districtElement = document.getElementById( districtElementId );          
                districtElement.length = 0;
                districtElement.options[0] = new Option('Select District','');
                districtElement.selectedIndex = 0;   
                var district_arr = district_a[selectedProvinceIndex+1].split("|");      
                for (var i = 0; i < district_arr.length; i++) {
                    districtElement.options[districtElement.length] = new Option(district_arr[i],district_arr[i]);
                }
            }

            function province(provinceElementId, districtElementId){
                var provinceElement = document.getElementById(provinceElementId);
                provinceElement.length = 0;
                var oprovince = document.getElementById('oprovince').value;

                for (var i = 0; i < province_arr.length; i++) {
                    if(oprovince == province_arr[i]) {
                        provinceElement.options[provinceElement.length] = new Option(province_arr[i], province_arr[i], false, true);

                        //create corresponding district
                        var districtElement = document.getElementById(districtElementId);          
                        districtElement.length = 0;
                        var odistrict = document.getElementById('odistrict').value;
                        var district_arr = district_a[i+1].split("|");      
                        for (var j = 0; j < district_arr.length; j++) {
                            if(odistrict == district_arr[j]) {
                                districtElement.options[districtElement.length] = new Option(district_arr[j], district_arr[j], false, true);
                            } else {
                                districtElement.options[districtElement.length] = new Option(district_arr[j], district_arr[j]);
                            }
                        }
                    } else {
                        provinceElement.options[provinceElement.length] = new Option(province_arr[i], province_arr[i]);
                    }
                }

                if(districtElementId){
                    provinceElement.onchange = function(){
                        district(provinceElementId, districtElementId);
                    };
                }
            }
            province("province", "district");
        });
    </script>
@endpush
