@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/search_result.css') }}">
@stop

@section('content')

	<div class="row main-content">
		<div class="col-md-3 col-xs-12 pull-right">
			<div class="row">
				<div class="col-md-12">
					{!! Form::open(['route' => ['frontend.tradevillage.search'], 'method' => 'get']) !!}
				        <div class="input-group add-on">
			            	<input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search') }}" name="search" id="srch-term" value="{{isset($key)? $key: ''}}" type="text">
			            	<div class="input-group-btn">
			                	<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            	</div>
				        </div>
				    {!! Form::close() !!}
				</div>
			</div>
		</div>

		<h4><b>Search</b> > "{{ $key }}"</h4>
		<hr>
		<div class="row">
			@if(count($villages)+count($enterprises)+count($artists)+count($products)>0)
				<div class="row trade-villages">
					<h4 class="orange-text title"><b>{{ trans('tradevillage::main.title.village') }}</b></h4>
					<?php $i=0 ?>
					@if(count($villages)>0)
						@foreach( $villages as $village )
						<div class="col-md-12 village">
		                    <div class="row">
		                        <div class="col-md-1 col-sm-3 col-xs-3 village-image-index">
		                        	<img src="@thumbnail($village->image_village->path, 'mediumThumb')" class="thumbnail village-spec img-responsive"/>
		                        </div>
		                        <div class="col-md-8 col-sm-9 col-xs-9">
		                            <h4><a href="{{ route('frontend.tradevillage.villages.show', [$village->id]) }}">{{ $village->translate(locale())->name }}</a></h4>
		                            <p class="group inner list-group-item-text intro">
					                        {!! $village->translate(locale())->description !!} </p>
		                        </div>
		                    </div>
		                </div>
						@endforeach
					@else
						{{ trans('tradevillage::main.title.no_village') }}
					@endif
				</div>

				<div class="row">
					<h4 class="orange-text"><b>{{ trans('tradevillage::main.title.event') }}</b></h4>
					@if(count($events)>0)
						@foreach($events as $event)
					        <div class="item col-md-12 col-sm-12">
					            <div class="item-thumbnail row">
					                <div class="caption col-md-9 col-sm-9 col-xs-9">
					                    <a href="{{ route('frontend.tradevillage.events.show', $event->id) }}"><h4 class="group inner list-group-item-heading product-name oneline"><b>
					                        {{ $event->translate(locale())->title }}</b></h4></a>
					                </div>
					            </div>
					            <hr>
					        </div>
					    @endforeach
					@else
						{{ trans('tradevillage::main.title.no_event') }}
					@endif
				</div>

				<div class="row">
					<h4 class="orange-text"><b>{{ trans('tradevillage::main.title.new') }}</b></h4>
					@if(count($news)>0)
						@foreach($news as $new)
					        <div class="item col-md-12 col-sm-12">
					            <div class="item-thumbnail row">
					                <div class="caption col-md-9 col-sm-9 col-xs-9">
					                    <a href="{{ route('frontend.tradevillage.news.show', $new->id) }}"><h4 class="group inner list-group-item-heading product-name oneline"><b>
					                        {{ $new->translate(locale())->title }}</b></h4></a>
					                </div>
					            </div>
					            <hr>
					        </div>
					    @endforeach
					@else
						{{ trans('tradevillage::main.title.no_new') }}
					@endif
				</div>

				<div class="row content-background">
					<h4 class="orange-text"><b>{{ trans('tradevillage::main.title.enterprise') }}</b></h4>
					@if(count($enterprises)>0)
						@foreach( $enterprises as $enterprise)
							<div class="item col-md-12 col-sm-12">
					            <div class="item-thumbnail row">
					                <div class="col-md-1 col-sm-3  col-xs-3 enterprise-index-image">
					                    <img src="{{ Imagy::getThumbnail($enterprise->feature_image['path'].'', 'mediumThumb') }}" class="enterprise-index-avatar img-responsive thumbnail" />
					                </div>
					                <div class="caption col-md-9 col-sm-9  col-xs-9">
					                    <a href="{{ route('frontend.tradevillage.enterprises.show', $enterprise->id) }}"><h4 class="group inner list-group-item-heading product-name oneline"><b>
					                        {{ $enterprise->translate(locale())->name }}</b></h4></a>
					                    <p class="group inner list-group-item-text intro">
					                        {!! $enterprise->translate(locale())->description !!} </p>
					                </div>
					            </div>
					        </div>
						@endforeach
					@else
						{{ trans('tradevillage::main.title.no_enterprise') }}
					@endif
				</div>

				<div class="row">
					<h4 class="orange-text"><b>{{ trans('tradevillage::main.title.artist') }}</b></h4>
					@if(count($artists)>0)
						@foreach($artists as $artist)
					        <div class="item col-md-12 col-sm-12">
					            <div class="item-thumbnail row">
					                <div class="col-md-1 col-sm-3  col-xs-3 artist-index-avatar">
					                    <img src="{{ Imagy::getThumbnail($artist->feature_image['path'].'', 'mediumThumb') }}" class="artist-index-avatar img-responsive" />
					                </div>
					                <div class="caption col-md-9 col-sm-9 col-xs-9">
					                    <a href="{{ route('frontend.tradevillage.artist.show', $artist->id) }}"><h4 class="group inner list-group-item-heading product-name oneline"><b>
					                        {{ $artist->translate(locale())->name }}</b></h4></a>
					                    <p class="group inner list-group-item-text intro">
					                        {!! $artist->translate(locale())->description !!} </p>
					                </div>
					            </div>
					            <hr>
					        </div>
					    @endforeach
					@else
						{{ trans('tradevillage::main.title.no_artist') }}
					@endif
				</div>

				<div class="row products">
					<h4 class="orange-text"><b>{{ trans('tradevillage::main.title.product') }}</b></h4>
					@if(count($products)>0)
						@foreach($products as $product)
							<div class="col-md-2 col-sm-3 col-xs-6">
								<div class="product">
									<?php $image_direct = public_path().$product->images ?>
		                			<a href="{{ route('frontend.tradevillage.products.show', $product->id) }}"><img class="group list-group-image img-responsive thumbnail" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}"></a>
									<div class="overlay">
									    <div class="text">
									    	<b>{{ $product->translate(locale())->name }}</b>
									    	<p class="description">{{ $product->translate(locale())->description }}</p>
									    </div>
									</div>
								</div>
							</div>
						@endforeach
					@else
						{{ trans('tradevillage::main.title.no_product') }}
					@endif
				</div>
			@else
				<div class="col-md-9">
					<h3 class="center">{{ trans('tradevillage::main.title.no_result') }}</h3>
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
@stop