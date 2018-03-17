<div class="thumbnail">
	<div class="similar-events">
		<h4 class="orange-text"><b>{{ trans('tradevillage::events.similar_events') }}</b></h4>
		@foreach($similar_events as $similar_event)
			@if($event->id != $similar_event->id)
				<div class="row sidebar-event">
					<div class="col-md-3 col-xs-3">
						<img src="{{ Imagy::getThumbnail($similar_event->feature_image['path'].'', 'smallThumb') }}" class="img-responsive thumbnail event-sidebar-image" />
					</div>
					<div class="col-md-9 col-xs-9 sidebar_title">
						<a href="{{ route('frontend.tradevillage.events.show', $similar_event->id) }}">{{ $similar_event->translate(locale())->title }}</a>
					</div>
				</div>
			@endif
		@endforeach
	</div>
	<hr>
	<div class="newest-events">
		<h4 class="orange-text"><b>{{ trans('tradevillage::events.newest_events') }}</b></h4>
		@foreach($top_events as $top_event)
			@if($event->id != $top_event->id)
				<div class="row sidebar-event">
					<div class="col-md-3 col-xs-3">
						<img src="{{ Imagy::getThumbnail($top_event->feature_image['path'].'', 'smallThumb') }}" class="img-responsive thumbnail event-sidebar-image" />
					</div>
					<div class="col-md-8 col-xs-9 sidebar_title">
						<a href="{{ route('frontend.tradevillage.events.show', $top_event->id) }}">{{ $top_event->translate(locale())->title }}</a>
					</div>
				</div>
			@endif
		@endforeach
	</div>
</div>