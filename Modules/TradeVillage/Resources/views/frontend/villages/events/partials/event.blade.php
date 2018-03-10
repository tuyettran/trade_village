<div class="row thumbnail event">
	<h4 class="title"><b><a href="{{ route('frontend.tradevillage.events.show', $event->id) }}" class="orange-text">{{ $event->translate(locale())->title }}</a></b></h4>
	<div class="row">
		<div class="col-md-2 col-xs-4">
			<img src="{{ Imagy::getThumbnail($event->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail event-index-image" />
		</div>
		<div class="col-md-10 col-xs-8">
			<p>
				<b>{{ trans('tradevillage::events.start_time') }}: </b> {{ $event->start_time }} || 
				<span><b>{{ trans('tradevillage::events.end_time') }}: </b> {{ $event->end_time }} </span>
			</p>
			<div class="description">{!! $event->translate(locale())->content !!}</div>
			<p class="darkgrey-text">{{ $event->created_at }}</p>
		</div>
	</div>
</div>