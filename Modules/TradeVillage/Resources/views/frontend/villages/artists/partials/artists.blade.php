@if(count($artists) > 0)
    @foreach($artists as $artist)
        <div class="item col-md-6 col-sm-12">
            <div class="item-thumbnail row">
                <div class="col-md-3 col-sm-3">
                    <img src="{{ Imagy::getThumbnail($artist->feature_image['path'].'', 'mediumThumb') }}" class="col-md-4 artist-index-avatar img-responsive" />
                </div>
                <div class="caption col-md-9 col-sm-9">
                    <a href="{{ route('frontend.tradevillage.artist.show', $artist->id) }}"><h4 class="group inner list-group-item-heading product-name oneline"><b>
                        {{ $artist->translate(locale())->name }}</b></h4></a>
                    <p class="group inner list-group-item-text intro">
                        {!! $artist->translate(locale())->description !!} </p>
                    <p class="group inner list-group-item-text intro">
                        {{ trans('tradevillage::artists.village name') }} : 
                        <a href="{{ route('frontend.tradevillage.villages.show', $artist->village->id) }}"><b>{!! $artist->village->translate(locale())->name !!}</b></a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>{{ trans('tradevillage::artists.no_artist') }}</p>
@endif