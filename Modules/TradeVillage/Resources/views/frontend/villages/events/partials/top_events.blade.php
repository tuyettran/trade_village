<div class="row thumbnail">
	<div class="top-events">
		<div class="col-md-6 col-xs-12">
			<div class="big-image">
				<img src="{{ Imagy::getThumbnail($top_events[0]->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail" />
				<div class="center-bottom">
					<h3><b><a href="{{ route('frontend.tradevillage.events.show', $top_events[0]->id) }}" class="white-text">{{ $top_events[0]->translate(locale())->title }}</a></b></h3>
				</div>
			</div>
		</div>
		<div class="col-md-6 event-image">
			<div class="row">
				<div class="col-md-6 col-xs-6 small-image">
					<img src="{{ Imagy::getThumbnail($top_events[1]->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail" />
					<div class="center-bottom">
						<h4><b><a href="{{ route('frontend.tradevillage.events.show', $top_events[1]->id) }}" class="white-text">{{ $top_events[1]->translate(locale())->title }}</a></b></h4>
					</div>
				</div>
				<div class="col-md-6 col-xs-6 small-image">
					<img src="{{ Imagy::getThumbnail($top_events[2]->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail" />
					<div class="center-bottom">
						<h4><b><a href="{{ route('frontend.tradevillage.events.show', $top_events[2]->id) }}" class="white-text">{{ $top_events[2]->translate(locale())->title }}</a></b></h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-xs-6 small-image">
					<img src="{{ Imagy::getThumbnail($top_events[3]->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail" />
					<div class="center-bottom">
						<h4><b><a href="{{ route('frontend.tradevillage.events.show', $top_events[3]->id) }}" class="white-text">{{ $top_events[3]->translate(locale())->title }}</a></b></h4>
					</div>
				</div>
				<div class="col-md-6 col-xs-6 small-image">
					<img src="{{ Imagy::getThumbnail($top_events[4]->feature_image['path'].'', 'largeThumb') }}" class="img-responsive thumbnail" />
					<div class="center-bottom">
						<h4><b><a href="{{ route('frontend.tradevillage.events.show', $top_events[4]->id) }}" class="white-text">{{ $top_events[4]->translate(locale())->title }}</a></b></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>