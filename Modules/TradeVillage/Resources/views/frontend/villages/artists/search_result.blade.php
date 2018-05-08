@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/artist.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		{!! Form::open(['route' => ['frontend.tradevillage.search.artist'], 'method' => 'get', 'id' => 'filter_search_form']) !!}
			<div class="col-md-3 pull-right search-box">
				<div class="col-md-12 no-padding">
			        <div class="input-group add-on">
			            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search artist') }}" name="search" id="srch-term" type="text" value="{{ isset($key)? $key: '' }}">
			            <div class="input-group-btn">
			                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
				</div>
			</div>
			<div class="col-md-9 filter">
				@if(isset($category))
					@include('tradevillage::frontend.villages.artists.partials.filter', ['categories' => $categories, 'category' => $category])
				@else
					@include('tradevillage::frontend.villages.artists.partials.filter', ['categories' => $categories])
				@endif
			</div>

		{!! Form::close() !!}
	</div>
	<div class="row">
		@if(isset($key))
			<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.events.index') }}"><b>{{ trans('tradevillage::main.filter.artist') }}</b></a> > "{{ $key }}"</h4>
		@elseif(isset($category))
			<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.events.index') }}">{{ trans('tradevillage::main.filter.artist') }}</a> > <a href="#">{{ $category->translate(locale())->name }}</a></h4>
		@else
			<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.events.index') }}">{{ trans('tradevillage::main.filter.artist') }}</a> > {{ trans('tradevillage::main.title.all') }}</h4>
		@endif
		<hr>
		<div class="col-md-12 col-sm-12">
   			@if(count($artists)>0)
				<div class="row">
					@foreach($artists as $artist)
				        <div class="row enterprise">
							<div class="row">
								<div class="col-md-1 col-xs-4">
									<img src="{{ Imagy::getThumbnail($artist->feature_image['path'].'', 'mediumThumb') }}" class="img-responsive thumbnail" />
								</div>
								<div class="col-md-10 col-xs-8">
									<h4 class="title"><b><a href="{{ route('frontend.tradevillage.enterprises.show', $artist->id) }}" class="orange-text">{{ $artist->translate(locale())->name }}</a></b></h4>
									<p class="description">{!! $artist->translate(locale())->description !!}</p>
								</div>
							</div>
						</div>
				    @endforeach
				</div>
				{{ $artists->links() }}
			@else
				<div class="col-md-9">
					<h3 class="center">{{ trans('tradevillage::main.title.no_artist') }}</h3>
				</div>
			@endif
        </div>
        
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-artists').addClass("active-nav");
    $( document ).ready(function() {
    	$('#category_select').change(function(){
    		$('#filter_search_form').submit();
    	})
    });
</script>
@stop