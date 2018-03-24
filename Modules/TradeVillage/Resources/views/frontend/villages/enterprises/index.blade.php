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
		@if(!isset($village))
			<div class="col-md-9 filter">
				@include('tradevillage::frontend.villages.artists.partials.filter', ['categories' => $categories])
			</div>
		@else
			<h4><a href="">{{ $village->translate(locale())->name }}</a> > {{ trans('tradevillage::enterprises.title.enterprises') }}</h3>
		@endif
		
	</div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12">
   			<div class="list-group">
   				@include('tradevillage::frontend.villages.enterprises.partials.enterprise', ['enterprises' => $enterprises])
   			</div>
   			{{ $enterprises->links() }}
        </div>
        
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-enterprises').addClass("active-nav");
</script>
@stop