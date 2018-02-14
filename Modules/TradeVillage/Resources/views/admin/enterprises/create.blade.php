@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::enterprises.title.create enterprises') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.enterprises.index') }}">{{ trans('tradevillage::enterprises.title.enterprises') }}</a></li>
        <li class="active">{{ trans('tradevillage::enterprises.title.create enterprises') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.enterprises.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.enterprises.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        <input id="submit" type="button" value="Get coordinates">
                        <input id="lat" name="lat" style="display: none;">
                        <input id="lng" name="lng" style="display: none;">
                        <div class="col-md-12" id="map" style="width:100%;height: 300px;"></div>

                        <div class="form-group{{ $errors->has("user_id") ? " has-error" : "" }}">
                            {!! Form::label("user_id", trans("tradevillage::enterprises.form.user")) !!} 
                                <select name="user_id">
                                    <option value="">--None--</option>
                                    @if( isset($users))
                                    @foreach( $users as $user)
                                        <option value={{$user->id}}>{{$user->first_name}} {{$user->last_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            {!! $errors->first("user_id", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("website") ? " has-error" : "" }}">
                            {!! Form::label("website", trans("tradevillage::enterprises.form.website")) !!}
                            
                            {!! Form::text("website", old("website"), ["class" => "form-control", "placeholder" => trans("tradevillage::enterprises.form.website")]) !!}
                            
                            {!! $errors->first("website", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("contact") ? " has-error" : "" }}">
                            {!! Form::label("contact", trans("tradevillage::enterprises.form.contact")) !!}
                            
                            {!! Form::text("contact", old("contact"), ["class" => "form-control", "placeholder" => trans("tradevillage::enterprises.form.contact")]) !!}
                            
                            {!! $errors->first("contact", '<span class="help-block">:message</span>') !!}
                        </div>
                        @mediaSingle('feature_image')
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.enterprises.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
        var myLatLng = {lat: 21.027764, lng: 105.834160};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });

        var geocoder = new google.maps.Geocoder();
        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        
        function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function(results, status) {
              if (status === 'OK') {
                document.getElementById('lat').value = results[0].geometry.location.lat();
                document.getElementById('lng').value = results[0].geometry.location.lng();
                var myLatLng = {lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng()};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 18,
                    center: myLatLng
                });

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map
                });
              } else {
                alert('Geocode was not successful for the following reason: ' + status);
              }
            });
        }  
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.tradevillage.enterprises.index') ?>" }
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
