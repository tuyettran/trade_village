@if(count($artists) > 0)
    @foreach($artists as $artist)
        <div class="item col-md-6 col-sm-6 col-xs-12">
            <div class="item-thumbnail row">
                <div class="col-md-4">
                    <img src="{{ Imagy::getThumbnail($artist->feature_image['path'].'', 'mediumThumb') }}" class="col-md-4 artist-index-avatar img-responsive" />
                </div>
                <div class="caption col-md-8">
                    <a href="{{ route('frontend.tradevillage.artist.show', $artist->id) }}"><h4 class="group inner list-group-item-heading product-name oneline">
                        {{ $artist->translate(locale())->name }}</h4></a>
                    <p class="group inner list-group-item-text intro">
                        {!! $artist->translate(locale())->description !!} </p>
                    <p class="group inner list-group-item-text intro">
                        {{ trans('tradevillage::artists.village name') }} : 
                        <a href="">{!! $artist->village->translate(locale())->name !!}</a>
                    </p>
                    
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>Khong co nghe nhan nao</p>
@endif