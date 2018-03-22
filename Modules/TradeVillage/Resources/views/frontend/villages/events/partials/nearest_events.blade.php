@foreach($nearest_events as $event)
	<div class="row near_event">
		<img src="{{ Imagy::getThumbnail($event->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail col-md-2 col-sm-4" />
		<div class="col-md-10 col-sm-8">
			<b><a href="{{ route('frontend.tradevillage.events.show', $event->id) }}" class="blue-text">{{ $event->translate(locale())->title }}</a></b>
		</div>
	</div>
@endforeach