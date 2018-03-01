@foreach($category->products as $product)
<div class="item col-md-3 col-sm-4 col-xs-6">
    <div class="thumbnail">
        <?php $image_direct = public_path().$product->images ?>
        <img class="group list-group-image img-responsive" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}">
        <div class="caption">
            <a href="#"><h5 class="group inner list-group-item-heading product-name oneline">
                {{ $product->translate(locale())->name }}</h5></a>
            <p class="group inner list-group-item-text intro">
                {{ $product->cost }} </p>

            @can('update-product', $product)
                <a href={{route('frontend.tradevillage.products.edit', [$product->id])}}><span class="glyphicon glyphicon-pencil"></span></a>
                <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('frontend.tradevillage.products.destroy', [$product->id]) }}"><i class="fa fa-trash"></i></button>
            @endcan
        </div>
    </div>
</div>
@endforeach