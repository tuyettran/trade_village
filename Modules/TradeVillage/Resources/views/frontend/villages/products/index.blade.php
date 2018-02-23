@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/educateIndex.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/videoDetail.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<form class="navbar-form pull-right search-form" role="search">
		        <div class="input-group add-on">
		            <input class="form-control" placeholder="Tìm kiếm sản phẩm..." name="srch-term" id="srch-term" type="text">
		            <div class="input-group-btn">
		                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		    </form>
		</div>
		<div class="col-md-9 filter">
			@include('tradevillage::frontend.education.partials.filter', ['lang' => locale()])
		</div>
		
	</div>
	
	<div class="row">
		<a><h3>Mây tre đan</h3></a>
		@foreach ($products as $product)
			<ul>
				<li>
					{{ $product->chapter }}
					<a href="{{ route('frontend.tradevillage.products.index') }}">
			            <h3>{{ $product->translate(locale())->description }}</h3>
			        </a>
			        <a href="{{ route('frontend.tradevillage.products.index') }}">
			        	{{ $product->translate(locale())->name }}
			        </a>
			        <a href="{{ route('frontend.tradevillage.products.index') }}">
			        	{{ $product->translate(locale())->material }}
			        </a>
				</li>
			</ul>
		@endforeach
		{{ $products->links() }}
	</div>
	
@stop