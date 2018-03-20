<div class="navbar-form bar">
    <div>
        <a href="#"><h4 class="text">{{ trans('tradevillage::main.sidebar.hot_products') }}</h4></a>
        <ul class="list-group list">
            @if(isset($favorite))
                @foreach($favorite as $product)
                    <?php $image_direct = public_path().$product->images ?>
                    <li><a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}" class="img-thumbnail img-bar img-responsive"><span> {{ $product->translate(locale())->name}} </span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <hr/>
    <div>
        <a href="#"><h4 class="text">{{ trans('tradevillage::main.sidebar.newest_products') }}</h4></a>
        <ul class="list-group list">
            @if(isset($newest_products))
                @foreach($newest_products as $product)
                    <?php $image_direct = public_path().$product->images ?>
                    <li><a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}" class="img-thumbnail img-bar img-responsive"><span> {{ $product->translate(locale())->name}} </span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
</div>