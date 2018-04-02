@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/artist.css') }}">

@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<div class="col-md-12 no-padding">
				{!! Form::open(['route' => ['frontend.tradevillage.search.artist'], 'method' => 'get']) !!}
			        <div class="input-group add-on">
			            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search artist') }}" name="search" id="srch-term" type="text" value="{{ $key }}">
			            <div class="input-group-btn">
			                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
			    {!! Form::close() !!}
			</div>
		</div>
	</div>
	
	<div class="row">
		<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.events.index') }}"><b>{{ trans('tradevillage::main.filter.artist') }}</b></a> > "{{ $key }}"</h4>
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
</script>
@stop