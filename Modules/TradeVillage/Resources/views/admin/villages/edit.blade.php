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
                        
                        @mediaSingle('image_village',$villages)
                    </div>

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
            var province_arr = new Array("Hà Nội", "Hải Dương", "Tp.Hồ Chí Minh");

            var district_a = new Array();
            district_a[0] = "";
            district_a[1] = "Ba Đình|Hai Bà Trưng|Từ Liêm|Cầu Giấy";
            district_a[2] = "Thanh Hà|Nam Sách|Kinh Môn";
            district_a[3] = "Bình Thạnh|Tân Bình";

            function district( provinceElementId, districtElementId ){              
                var selectedProvinceIndex = document.getElementById( provinceElementId ).selectedIndex;
                var districtElement = document.getElementById( districtElementId );          
                districtElement.length = 0;
                districtElement.options[0] = new Option('Select State','');
                districtElement.selectedIndex = 0;   
                var district_arr = district_a[selectedProvinceIndex].split("|");      
                for (var i = 0; i < district_arr.length; i++) {
                    districtElement.options[districtElement.length] = new Option(district_arr[i],district_arr[i]);
                }
            }

            function province(provinceElementId, districtElementId){
                var provinceElement = document.getElementById(provinceElementId);
                provinceElement.length = 0;
                provinceElement.options[0] = new Option('Select Country','-1');
                provinceElement.selectedIndex = 0;
                for (var i = 0; i < province_arr.length; i++) {
                    provinceElement.options[provinceElement.length] = new Option(province_arr[i],province_arr[i]);
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
