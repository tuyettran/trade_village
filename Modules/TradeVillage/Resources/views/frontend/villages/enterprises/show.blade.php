@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/enterprise.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<div class="col-md-12">
				{!! Form::open(['route' => ['frontend.tradevillage.search.enterprise'], 'method' => 'get']) !!}
			        <div class="input-group add-on">
			            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search enterprise') }}" name="srch-term" id="srch-term" type="text">
			            <div class="input-group-btn">
			                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
			    {!! Form::close() !!}
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-9 col-sm-12">
   			<div class="row">
   				<div class="col-md-6 col-sm-12 image">
   					<img src="{{ Imagy::getThumbnail($enterprise->feature_image['path'].'', 'largeThumb') }}" class="enterprise-image-detail img-responsive thumbnail" />
   					
   				</div>
	   			<div class="col-md-6 col-sm-12">
	   				<h3 class="blue-text"><b>{{ $enterprise->translate(locale())->name }}</b></h3>
	   				<div class="col-md-12 table-responsive">
	   					<table class="table">
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::enterprises.website') }}: 
		   						</th>
		   						<td>
		   							<a href="{{ $enterprise->website }}">{{ $enterprise->website }}</a>
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::enterprises.contact') }}: 
		   						</th>
		   						<td>
		   							{{ $enterprise->contact }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::enterprises.address') }}: 
		   						</th>
		   						<td>
		   							{{ $enterprise->translate(locale())->address }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::enterprises.category') }}: 
		   						</th>
		   						<td>
		   							{{ $enterprise->village->category->translate(locale())->name }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::enterprises.village name') }}: 
		   						</th>
		   						<td>
		   							{{ $enterprise->village->translate(locale())->name }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::enterprises.description') }}: 
		   						</th>
		   						<td>
		   							{!! $enterprise->translate(locale())->description !!}
		   						</td>
		   					</tr>
		   				</table>
	   				</div>
	   			</div>
   			</div>
   			<div class="enterprise-detail">
   				<h4><b>Chi tiết</b></h4>
   				{!! $enterprise->translate(locale())->detail !!}
   			</div>
        </div>
        <div class="col-md-3 col-sm-12">
        	<div style="height: 15px;"></div>
        	<div id="map" style="width:100%;height: 300px;"></div>
        	<input type="text" id="olat" value="{{ $enterprise->lat }}" style="display: none;">
            <input type="text" id="olng" value="{{ $enterprise->lng }}" style="display: none;">
   			<hr>
   			<h4 class="orange-text"><b>{{ trans('tradevillage::enterprises.products') }}</b></h4>
   			@foreach($products as $product)
   				@include('tradevillage::frontend.villages.artists.partials.product', ['product' => $product])
   			@endforeach
        </div>
	</div>
@stop

@section('scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZMQRL3iYa5SHiluzgTJrHA_otrA52ec&libraries=drawing"></script>
<script type="text/javascript">
	var lat = document.getElementById("olat").value;
	var lng = document.getElementById("olng").value;
	var mapEnterprise = document.getElementById("map");
	var myCenter = new google.maps.LatLng(lat, lng); 
	var mapOptions = {center: myCenter, zoom: 16};
	var map = new google.maps.Map(mapEnterprise, mapOptions);
	var marker = new google.maps.Marker({
	    position: myCenter,
	    icon: '/images/icon10.png',
	    animation: google.maps.Animation.BOUNCE
	});
	marker.setMap(map);
</script>

<script type="text/javascript">
    $('.nav-enterprises').addClass("active-nav");
</script>
@stop