<div class="item col-md-12 col-xs-12">
    <div class="product-thumbnail row">
        <?php $image_direct = public_path().$product->images ?>
        <div class="col-md-3">
            <img class="group list-group-image img-responsive" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}">
        </div>
        <div class="caption col-md-9">
            <a href="{{ route('frontend.tradevillage.products.show', $product->id) }}"><h4 class="group inner list-group-item-heading product-name oneline">
                {{ $product->translate(locale())->name }}</h4></a>
            <p class="group inner list-group-item-text intro">
                {!! $product->translate(locale())->description !!} </p>
        </div>
    </div>
</div>