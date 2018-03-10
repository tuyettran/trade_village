@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/event.css') }}">

@stop

@section('content')
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
	</div>
	
	<div class="row">
		<div class="col-md-9 col-sm-12">
   			<div class="event-content">
   				<h2><b class="blue-text title">{{ $event->translate(locale())->title }}</b></h2>
   				<div class="row pull-right">
   					<h4 class="orange-text"><b>{{ trans('tradevillage::events.start_time') }}: {{ $event->start_time }}</b> || 
   					<b>{{ trans('tradevillage::events.end_time') }}: {{ $event->end_time }}</b></h4>
   					<h4 class="orange-text"><b>{{ trans('tradevillage::events.address') }}: {{ $event->translate(locale())->address }}</b></h4>
   				</div>
   				<div class="row content">
   					{!! $event->translate(locale())->content !!}
   				</div>
   			</div>

        </div>
        <div class="col-md-3 col-sm-12">
   			<div class="event-sidebar">
   				@include('tradevillage::frontend.villages.events.partials.sidebar', ['top_events' => $top_events, 'similar_events' => $similar_events, 'event' => $event])
   			</div>
        </div>
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-events').addClass("active-nav");
</script>
@stop