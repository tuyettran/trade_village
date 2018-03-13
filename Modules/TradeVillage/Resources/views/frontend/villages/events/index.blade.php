@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/event.css') }}">

@stop

@section('content')
	<div class="list-group top_events">
		@include('tradevillage::frontend.villages.events.partials.top_events', ['top_events' => $top_events])
	</div>
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<form class="navbar-form pull-right search-form" role="search">
		        <div class="input-group add-on">
		            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search event') }}" name="srch-term" id="srch-term" type="text">
		            <div class="input-group-btn">
		                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		    </form>
		</div>
		<div class="col-md-9 filter">
			@include('tradevillage::frontend.villages.events.partials.filter', ['categories' => $categories])
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-9 col-sm-12">
   			<div class="list-group events">
   				@foreach($events as $event)
   					@include('tradevillage::frontend.villages.events.partials.event', ['event' => $event])
   				@endforeach
   				{{ $events->links() }}
   			</div>
        </div>
        
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-events').addClass("active-nav");
</script>
@stop