<div class="navbar-form {{ isset($village)? 'bar':'margin-top-bar'}} index-product-navbar">
    <div>
        <a href="#"><h4 class="orange-text">{{ trans('tradevillage::main.sidebar.hot_products') }}</h4></a>
        @if(isset($favorite))
            @foreach($favorite as $product)
                <div class="row sidebar-product">
                    <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img src="{{ asset(substr(Storage::files('/public/product/images/'.$product->id)[0],7)) }}" class="img-thumbnail img-bar img-responsive col-md-2">
                    <span class="col-md-9 no-padding-right"> {{ $product->translate(locale())->name}} </span></a>
                </div>
            @endforeach
        @endif
    </div>
    <hr/>
    <div>
        <a href="#"><h4 class="orange-text">{{ trans('tradevillage::main.sidebar.newest_products') }}</h4></a>
        @if(isset($newest_products))
            @foreach($newest_products as $product)
                <div class="row sidebar-product">
                    <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img src="{{ asset(substr(Storage::files('/public/product/images/'.$product->id)[0],7)) }}" class="img-thumbnail img-bar img-responsive col-md-2">
                <span class="col-md-9 no-padding-right"> {{ $product->translate(locale())->name}} </span></a>
                </div>
            @endforeach
        @endif
    </div>
</div>