<div class="item col-md-12 col-xs-12">
    <div class="row">
        <div class="col-md-3">
            <img class="group list-group-image img-responsive thumbnail" src="{{ asset(substr(Storage::files('/public/product/images/'.$product->id)[0],7)) }}">
        </div>
        <div class="caption col-md-9">
            <a href="{{ route('frontend.tradevillage.products.show', $product->id) }}"><h4 class="group inner list-group-item-heading product-name oneline">
                {{ $product->translate(locale())->name }}</h4></a>
            <p class="group inner list-group-item-text intro">
                {!! $product->translate(locale())->description !!} </p>
        </div>
    </div>
</div>