@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/event.css') }}">

@stop

@section('content')
	<div class="row">
		<div class="col-md-3 pull-right search-div">
			<div class="col-md-12 search-div">
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
	</div>
	<div class="row">
		<div class="col-md-9 col-sm-12">
   			<div class="list-group events">
   				@foreach($events as $event)
   					@include('tradevillage::frontend.villages.events.partials.event', ['event' => $event])
   					<hr/>
   				@endforeach
   				{{ $events->links() }}
   			</div>
        </div>
        <div class="col-md-3 col-sm-12 thumbnail index-sidebar">
			<div class="nearest_events">
				<h4 class="orange-text"><b>{{ trans('tradevillage::events.nearest_events') }}</b></h4>
				@include('tradevillage::frontend.villages.events.partials.nearest_events', ['nearest_events' => $nearest_events])
			</div>
		</div>
        
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-events').addClass("active-nav");
</script>
@stop