@foreach($products as $product)
<div class="item col-md-3 col-sm-4 col-xs-6">
    <div class="thumbnail">
        <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img class="group list-group-image img-responsive" src="{{ asset(substr(Storage::files('/public/product/images/'.$product->id)[0],7)) }}"></a>
        <div class="caption">
            <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><h5 class="group inner list-group-item-heading product-name oneline">
                {{ $product->translate(locale())->name }}</h5></a>
            
            <p class="group inner list-group-item-text intro">
                {{ $product->translate(locale())->description }} </p>

            <p class="blue-text pull-right">{{ trans('tradevillage::products.form.cost') }}:
                <span class="group inner list-group-item-text intro">
                {{ $product->cost }} </span> {{ trans('tradevillage::products.unit') }}
            </p>
            <!-- @can('update-product', $product)
                <a href={{route('frontend.tradevillage.products.edit', [$product->id])}}><span class="glyphicon glyphicon-pencil"></span></a>
                <button class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('frontend.tradevillage.products.destroy', [$product->id]) }}"><span class="glyphicon glyphicon-trash"></span></button>
            @endcan -->
        </div>
    </div>
</div>
@endforeach
@if(count($products) == 0)
    {{ trans('tradevillage::products.no product') }}
@endif