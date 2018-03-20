@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/homepage.css') }}">
@stop

@section('content')
	<div class="row main-content">
		<div class="col-md-9 col-xs-12">
			<div class="row trade-villages">
				<h4 class="orange-text title"><b>{{ trans('tradevillage::homepage.title.typical_village') }}</b></h4>
				<?php $i=0 ?>
				@foreach( $villages as $village )
				<div class="row village content-background thumbnail">
					<div class="col-md-7 image">
						<div class="village-image">
							<img src="{{ Imagy::getThumbnail($village->image_village['path'].'', 'largeThumb') }}" class="img-responsive thumbnail" />
							<div class="row pull-right bottom-right">
								<a href="" class="btn white-btn">{{ trans('tradevillage::homepage.title.come') }}</a>
							</div>
						</div>
						<p class="summary"><i><b>{{ $village->translate(locale())->description }}</b></i></p>
					</div>
					<div class="col-md-5 right-side-info">
						<div class="row village-info">
							<div class="infomation col-xs-6 col-md-12">
								<a href="#"><h3><b>{{ $village->translate(locale())->name }}</b></h3></a>
								<a href="#"><b>{{ count($village->enterprises) }} {{ trans('tradevillage::homepage.title.enterprises') }}</b></a><br>
								<a href="#"><b>35 {{ trans('tradevillage::homepage.title.products') }}</b></a><br>
								<a href="#"><b>{{ count($village->artists) }} {{ trans('tradevillage::homepage.title.artists') }}</b></a><br>
								<a href="#"><b>{{ count($village->events) }} {{ trans('tradevillage::homepage.title.events') }}</b></a><br>
								<a href=""><b>{{ $village->visitor_counter }} {{ trans('tradevillage::homepage.title.visitors') }}</b></a>
							</div>
							<div class="col-md-12 col-xs-6 map-box">
								<img src="../assets/images/google-map.png" class="img-responsive thumbnail village-map pull-right col-md-12 col-xs-12" id="map_{{ $i }}">
							</div>
						</div>
					</div>
				</div>
				<?php $i++ ?>
				@endforeach
			</div>

			<div class="row top-enterprise content-background">
				<a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::homepage.title.top_edu_enterprises') }}</b></h4></a>
				<div class="col-md-4 col-xs-12 infomation">
					<p>{{ trans('tradevillage::homepage.title.top_edu_description') }}</p>
				</div>
				@foreach( $enterprises as $enterprise)
					<div class="col-md-2 col-xs-3 enterprise thumbnail">
						<a href="#"><img src="{{ Imagy::getThumbnail($enterprise->feature_image['path'].'', 'largeThumb') }}" class="img-responsive" /></a>
						<div class="overlay">
						    <div class="text">{{ $enterprise->translate(locale())->name }}</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="row top-product">
				<a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::homepage.title.favorite_products') }}</b></h4></a>
				<div class="row">
					@foreach($products as $product)
						<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="product">
								<?php $image_direct = public_path().$product->images ?>
	                			<a href="{{ route('frontend.tradevillage.products.show', $product->id) }}"><img class="group list-group-image img-responsive thumbnail" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}"></a>
								<div class="overlay">
								    <div class="text">{{ $product->translate(locale())->name }}</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<!-- right sidebar -->
		<div class="col-md-3 right-side-box">
			<div class="row">
				<div class="col-md-12 pull-right">
					<form class="pull-right search-form" role="search">
				        <div class="input-group add-on">
				            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search') }}" name="srch-term" id="srch-term" type="text">
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>
				    </form>
				</div>
			</div>
			<div class="row introduction">
				<h4 class="orange-text"><b>{{ trans('tradevillage::homepage.title.introduction') }}</b></h4>
				<p><i>{{ trans('tradevillage::homepage.title.page_description') }}</i></p>
			</div>
			<div class="row top-news">
				<a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::homepage.title.hot news') }}</b></h4></a>
				<ul class="new-feed">
					@foreach( $news as $new )
					<li><p class="oneline"><a href="videoDetail.html"><span class="glyphicon glyphicon-list-alt"></span>&emsp;{{ $new->translate(locale())->title}}</a></p>
						<p class="darkgrey-text pull-right">{{ $new->created_at }}</p>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="row top-events">
				<a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::homepage.title.hot events') }}</b></h4></a>
				<ul class="new-feed">
					@foreach( $events as $event )
						<li><p class="oneline"><a href="{{ route('frontend.tradevillage.events.show', $event->id) }}"><span class="glyphicon glyphicon-list-alt"></span>&emsp;{{ $event->translate(locale())->title}}</a></p>
							<p class="darkgrey-text pull-right">{{ $event->created_at }}</p>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="row top-artists">
				<a href=""><h4 class="orange-text"><b>{{ trans('tradevillage::homepage.title.hot artists') }}</b></h4></a>
				<ul>
					@foreach( $artists as $artist )
						<li class="row" title="Trương Văn Tý">
							<a href="{{ route('frontend.tradevillage.artist.show', $artist->id) }}"><img src="{{ Imagy::getThumbnail($artist->feature_image['path'].'', 'mediumThumb') }}" class="img-responsive artist col-md-3 col-xs-2 img-circle" /></a>
							<a href="{{ route('frontend.tradevillage.artist.show', $artist->id) }}"><h5>{{ $artist->translate(locale())->name }} ({{ $artist->date_of_birth }})</h5></a>
							<a><p>{{ $artist->village->translate(locale())->name }}</p></a>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="row help">
				<img src="{{ URL::asset('images/ho-tro.png') }}" class="img-responsive">
				<h4 class="black-text hotline"><b>{{ trans('tradevillage::homepage.title.hotline') }}: 04.936.1738</b></h4>
			</div>
			<div class="row page-view-count">
				<h5><b class="orange-text">{{ trans('tradevillage::homepage.title.total_visitors') }}:</b><span>&emsp;1671627</span></h5>
				<h5 class="orange-text"><b>{{ trans('tradevillage::homepage.title.top countries') }}:</b></h5>
				<ul>
					<li>Vietnam: 89100</li>
					<li>China: 7183</li>
					<li>Korea: 18371</li>
				</ul>
				<a href="#" class="row black-text btn btn-xs btn-default">{{ trans('tradevillage::homepage.title.show all') }} >></a>
			</div>
		</div>
	</div>
@stop
@section('scripts')
	
<script type="text/javascript">
    $('.nav-home').addClass("active-nav");
</script>
@stop