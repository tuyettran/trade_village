@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productIndex.css') }}">
@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<form class="navbar-form pull-right search-form" role="search">
		        <div class="input-group add-on">
		            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search product') }}" name="srch-term" id="srch-term" type="text">
		            <div class="input-group-btn">
		                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		    </form>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				   	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				   	<li data-target="#myCarousel" data-slide-to="1"></li>
				</ol>
	            <div class="carousel-inner">
	            	<?php $i = 0 ?>
		            @if(isset($images))
		            	@foreach($images as $image)
		            		<div class="item {{ $i==0 ? 'active' : ''}}">
		            			<a href="#"><img class="group list-group-image img-responsive" src="{{ URL::asset(substr($image,7)) }}"></a>
		            		</div>
		            		<?php $i++ ?>
		            	@endforeach
		            @endif
		        </div>
		        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				</a>
	        </div>
        </div>
        <div class="col-md-8 col-xs-12">
        	<div class="product-infomation">
	        	<h3 class="orange-text"><b>{{ mb_strtoupper($product->translate(locale())->name, 'UTF-8') }}</b></h3>
	        	<table>
	        		<tr>
	        			<th class="table-title">{{ trans('tradevillage::products.description') }}</th>
	        			<td>{{ $product->translate(locale())->description }}</td>
	        		</tr>
	        		<tr>
	        			<th class="table-title">{{ trans('tradevillage::products.material') }}</th>
	        			<td>{{ $product->translate(locale())->material }}</td>
	        		</tr>
	        		<tr>
	        			<th class="table-title">{{ trans('tradevillage::products.category') }}</th>
	        			<td>{{ $product->category->translate(locale())->name }}</td>
	        		</tr>
	        		<tr>
	        			<th class="table-title">{{ trans('tradevillage::products.cost') }}</th>
	        			<td>{{ $product->cost }} {{ trans('tradevillage::products.unit') }}</td>
	        		</tr>
	        	</table>
	        	<div class="row">
	        		<div class="product-footer-box">
	        			<div class="col-md-3 col-xs-4">
		        			@include('tradevillage::frontend.villages.products.partials.rate', ['product' => $product])
		        		</div>
		        		<div class="col-md-5 col-xs-8">
		        			<p class="blue-text"><b>{{ trans('tradevillage::products.contact') }}</b></p>
		        			@if($product->enterprise)
                                <img src="{{ Imagy::getThumbnail($product->enterprise->feature_image['path'].'', 'smallThumb') }}"/>

		        				<a href="">{{ $product->enterprise->translate(locale())->name}}</a>
		        				<p>{{ trans('tradevillage::products.address') }}: {{ $product->enterprise->contact }}</p>
		        				<p>Website: {{ $product->enterprise->website }}</p>
		        				<p>{{ trans('tradevillage::products.address') }}: {{ $product->enterprise->translate(locale())->address}}</p>
		        			@elseif($product->artist)
		        				<img src="{{ Imagy::getThumbnail($product->artist->feature_image['path'].'', 'smallThumb') }}" style="border-radius: 50%; max-height: 50px" />
		        				<a href="">{{ $product->artist->translate(locale())->name}}</a>
		        				<p>{{ trans('tradevillage::products.address') }}: {{ $product->artist->translate(locale())->address}}</p>
		        				{{ $product->artist->contact }}
		        			@endif
		        		</div>
		        		@if($product->model)
			        		<div class="col-md-4 col-xs-12">
			        			<a href="{{ route('frontend.tradevillage.products.model', [$product->id]) }}" class="btn btn-primary" target="_blank">{{ trans('tradevillage::products.show_model') }}</a>
			        		</div>
			        	@endif
	        		</div>
	        	</div>
	        </div>
        </div>
	</div>

	<div class="row">
		<ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#detail"><b>{{ trans('tradevillage::products.detail') }}</b></a></li>
		    <li><a data-toggle="tab" href="#comments"><b>{{ trans('tradevillage::products.comments') }}</b></a></li>
		</ul>
		<div class="tab-content">
			<div id="detail" class="tab-pane fade in active">
				{!! $product->translate(locale())->detail !!}
			</div>
			<div id="comments" class="tab-pane fade">
				@include('tradevillage::frontend.villages.products.partials.comments', ['product' => $product])
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="refe-products">
			<h4><b>{{ trans('tradevillage::products.similar') }}</b></h4>
			@foreach ($categories as $category)
				@if($category->id == $product->category_id)
					<div class="row">
						<div class="categories-item col-md-8">
		               		<div id="products" class="row">
		               			<div class="list-group">
		               				@include('tradevillage::frontend.villages.products.partials.product', ['category' => $category, 'current_product' => $product])
		               			</div>
		                    </div>
						</div>
	                </div>
	            @endif
	        @endforeach
		</div>
		
	</div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-rating-input.min.js') }}"></script>	
<script type="text/javascript">
    $('.carousel').carousel({
	  	interval: false
	});
	$('.nav-products').addClass("active-nav");
</script>
@stop