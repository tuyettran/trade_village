@if(count($enterprises) > 0)
    @foreach($enterprises as $enterprise)
        <div class="item col-md-6 col-sm-12">
            <div class="item-thumbnail row">
                <div class="col-md-3 col-sm-3">
                    <img src="{{ Imagy::getThumbnail($enterprise->feature_image['path'].'', 'mediumThumb') }}" class="col-md-4 enterprise-index-avatar img-responsive thumbnail" />
                </div>
                <div class="caption col-md-9 col-sm-9">
                    <a href="{{ route('frontend.tradevillage.enterprises.show', $enterprise->id) }}"><h4 class="group inner list-group-item-heading product-name oneline"><b>
                        {{ $enterprise->translate(locale())->name }}</b></h4></a>
                    <p class="group inner list-group-item-text intro">
                        {!! $enterprise->translate(locale())->description !!} </p>
                    <p class="group inner list-group-item-text intro">
                        {{ trans('tradevillage::artists.village name') }} : 
                        <a href=""><b>{!! $enterprise->village->translate(locale())->name !!}</b></a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>{{ trans('tradevillage::enterprises.no_enterprise') }}</p>
@endif