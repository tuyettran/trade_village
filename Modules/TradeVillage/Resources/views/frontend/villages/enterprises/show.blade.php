@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/enterprise.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<form class="navbar-form pull-right search-form" role="search">
		        <div class="input-group add-on">
		            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search enterprise') }}" name="srch-term" id="srch-term" type="text">
		            <div class="input-group-btn">
		                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		    </form>
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
	   				<table>
	   					<tr>
	   						<th>
	   							{{ trans('tradevillage::enterprises.website') }}: 
	   						</th>
	   						<td>
	   							{{ $enterprise->website }}
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
   			<div class="enterprise-detail">
   				<h4><b>Chi tiết</b></h4>
   				{!! $enterprise->translate(locale())->detail !!}
   			</div>
        </div>
        <div class="col-md-3 col-sm-12">
   			<h4 class="blue-text"><b>{{ trans('tradevillage::enterprises.products') }}</b></h4>
   			@foreach($products as $product)
   				@include('tradevillage::frontend.villages.artists.partials.product', ['product' => $product])
   			@endforeach
        </div>
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-enterprises').addClass("active-nav");

</script>
@stop