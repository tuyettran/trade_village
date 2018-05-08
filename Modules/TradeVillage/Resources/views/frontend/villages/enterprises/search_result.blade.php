@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/search_result.css') }}">
@stop

@section('content')

	<div class="row main-content">
		<div class="row">
			{!! Form::open(['route' => ['frontend.tradevillage.search.enterprise'], 'method' => 'get', 'id' => 'filter_search_form']) !!}
				<div class="col-md-3 col-xs-12 pull-right search-box">
					<div class="col-md-12 no-padding">
				        <div class="input-group add-on">
			            	<input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search') }}" name="search" id="srch-term" value="{{isset($key)? $key: ''}}" type="text">
			            	<div class="input-group-btn">
			                	<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            	</div>
				        </div>
					</div>
				</div>
				<div class="col-md-9 filter">
					@if(isset($category))
						@include('tradevillage::frontend.villages.enterprises.partials.filter', ['categories' => $categories, 'category' => $category])
					@else
						@include('tradevillage::frontend.villages.enterprises.partials.filter', ['categories' => $categories])
					@endif
				</div>
			{!! Form::close() !!}
		</div>
		

		@if(isset($key))
			<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.enterprises.index') }}"><b>{{ trans('tradevillage::main.filter.enterprise') }}</b></a> > "{{ $key }}"</h4>
		@elseif(isset($category))
			<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.enterprises.index') }}"><b>{{ trans('tradevillage::main.filter.enterprise') }}</b></a> > <a href="#"><b>{{ $category->translate(locale())->name }}</b></a> ></h4>
		@else
			<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.enterprises.index') }}"><b>{{ trans('tradevillage::main.filter.enterprise') }}</b></a> > {{ trans('tradevillage::main.title.all') }} ></h4>
		@endif
		<hr>
		<div class="row">
			@if(count($enterprises)>0)
				<div class="row">
					@foreach($enterprises as $enterprise)
				        <div class="row enterprise">
							<div class="row">
								<div class="col-md-1 col-xs-4">
									<img src="{{ Imagy::getThumbnail($enterprise->feature_image['path'].'', 'mediumThumb') }}" class="img-responsive thumbnail" />
								</div>
								<div class="col-md-10 col-xs-8">
									<h4 class="title"><b><a href="{{ route('frontend.tradevillage.enterprises.show', $enterprise->id) }}" class="orange-text">{{ $enterprise->translate(locale())->name }}</a></b></h4>
									<p class="description">{{ $enterprise->translate(locale())->description }}</p>
								</div>
							</div>
						</div>
				    @endforeach
				</div>
				{{ $enterprises->links() }}
			@else
				<div class="col-md-9">
					<h3 class="center">{{ trans('tradevillage::main.title.no_enterprise') }}</h3>
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
<script type="text/javascript">
    $('.nav-enterprises').addClass("active-nav");
    $( document ).ready(function() {
    	$('#category_select').change(function(){
    		$('#filter_search_form').submit();
    	})
    });
</script>
@stop