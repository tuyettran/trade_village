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
			            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search artist') }}" name="search" id="srch-term" type="text">
			            <div class="input-group-btn">
			                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
				    
				</div>
			</div>

			@if(!isset($village))
			<div class="col-md-9 filter">
				@include('tradevillage::frontend.villages.artists.partials.filter', ['categories' => $categories])
			</div>
			@else
			<div class="col-md-9">
				<h4><a href="">{{ $village->translate(locale())->name }}</a> > {{ trans('tradevillage::artists.title.artists') }}</h4>
			</div>
			@endif
		{!! Form::close() !!}
	</div>
	
	<div class="row">
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
    		$('#filter_search_form').submit();
    	})
    });
</script>
@stop