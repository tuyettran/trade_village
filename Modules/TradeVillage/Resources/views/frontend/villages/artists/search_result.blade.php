@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/artist.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right search-box">
			<div class="col-md-12 no-padding">
				{!! Form::open(['route' => ['frontend.tradevillage.search.artist'], 'method' => 'get']) !!}
			        <div class="input-group add-on">
			            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search artist') }}" name="search" id="srch-term" type="text" value="{{ isset($key)? $key: '' }}">
			            <div class="input-group-btn">
			                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
			    {!! Form::close() !!}
			</div>
		</div>
		<div class="col-md-9 filter">
			@if(isset($category))
				@include('tradevillage::frontend.villages.artists.partials.filter', ['categories' => $categories, 'category' => $category])
			@else
				@include('tradevillage::frontend.villages.artists.partials.filter', ['categories' => $categories])
			@endif
		</div>
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
   			<div class="list-group">
   				@include('tradevillage::frontend.villages.artists.partials.artists', ['artists' => $artists])
   			</div>
   			{{ $artists->links() }}
        </div>
        
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-artists').addClass("active-nav");
    $( document ).ready(function() {
    	$('#category_select').change(function(){
    		$('#category-form').submit();
    	})
    });
</script>
@stop