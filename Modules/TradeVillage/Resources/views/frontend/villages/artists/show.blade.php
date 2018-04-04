@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/artist.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right no-padding">
			<div class="row">
				<div class="col-md-12 no-padding">
					{!! Form::open(['route' => ['frontend.tradevillage.search.artist'], 'method' => 'get']) !!}
				        <div class="input-group add-on">
				            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search artist') }}" name="search" id="srch-term" type="text">
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>
				    {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-9 col-sm-12">
   			<div class="row">
   				<div class="col-md-6 col-sm-12 image">
   					<img src="{{ Imagy::getThumbnail($artist->feature_image['path'].'', 'largeThumb') }}" class="artist-image-detail img-responsive" />
   					
   				</div>
	   			<div class="col-md-6 col-sm-12">
	   				<h3 class="blue-text"><b>{{ $artist->translate(locale())->name }}</b></h3>
	   				<div class="table-responsive">
	   					<table class="table">
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::artists.dob') }}: 
		   						</th>
		   						<td>
		   							{{ $artist->date_of_birth }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::artists.contact') }}: 
		   						</th>
		   						<td>
		   							{{ $artist->contact }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::artists.address') }}: 
		   						</th>
		   						<td>
		   							{{ $artist->translate(locale())->address }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::artists.category') }}: 
		   						</th>
		   						<td>
		   							{{ $artist->village->category->translate(locale())->name }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::artists.village name') }}: 
		   						</th>
		   						<td>
		   							{{ $artist->village->translate(locale())->name }}
		   						</td>
		   					</tr>
		   					<tr>
		   						<th>
		   							{{ trans('tradevillage::artists.description') }}: 
		   						</th>
		   						<td>
		   							{!! $artist->translate(locale())->description !!}
		   						</td>
		   					</tr>
		   				</table>
	   				</div>
	   			</div>
   			</div>
   			<div class="artist-detail">
   				<h4><b>Chi tiết</b></h4>
   				{!! $artist->translate(locale())->detail !!}
   			</div>
        </div>
        <div class="col-md-3 col-sm-12 thumbnail artist-sidebar">
   			<h4 class="blue-text"><b>{{ trans('tradevillage::artists.products') }}</b></h4>
   			@foreach($products as $product)
   				@include('tradevillage::frontend.villages.artists.partials.product', ['product' => $product])
   			@endforeach
        </div>
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-artists').addClass("active-nav");

</script>
@stop