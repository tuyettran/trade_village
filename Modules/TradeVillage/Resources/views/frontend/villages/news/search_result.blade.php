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
					{!! Form::open(['route' => ['frontend.tradevillage.search.new'], 'method' => 'get']) !!}
				        <div class="input-group add-on">
			            	<input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search') }}" name="search" id="search" value="{{isset($key)? $key: ''}}" type="text">
			            	<div class="input-group-btn">
			                	<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            	</div>
				        </div>
				    {!! Form::close() !!}
				</div>
			</div>
		</div>

		<h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.news.index') }}"><b>{{ trans('tradevillage::main.filter.new') }}</b></a> > "{{ $key }}"</h4>
		<hr>
		<div class="row">
			@if(count($news)>0)
				<div class="row">
					@foreach($news as $new)
				        <div class="row new">
							<div class="row">
								<div class="col-md-1 col-xs-4">
									<img src="{{ Imagy::getThumbnail($new->feature_image['path'].'', 'mediumThumb') }}" class="img-responsive thumbnail new-index-image" />
								</div>
								<div class="col-md-10 col-xs-8">
									<h4 class="title"><b><a href="{{ route('frontend.tradevillage.news.show', $new->id) }}" class="orange-text">{{ $new->translate(locale())->title }}</a></b></h4>
									<p class="darkgrey-text">{{ $new->created_at }}</p>
								</div>
							</div>
						</div>
				    @endforeach
				</div>
				{{ $news->links() }}
			@else
				<div class="col-md-9">
					<h3 class="center">{{ trans('tradevillage::main.title.no_new') }}</h3>
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
<script type="text/javascript">
    $('.nav-news').addClass("active-nav");
</script>
@stop