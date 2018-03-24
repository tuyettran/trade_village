<?php $i=0 ?>
@if(isset($user_id))
    @foreach($category->products as $product)
        @if($product->user_id == $user_id && $i<8)
        <div class="item col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <?php $image_direct = public_path().$product->images ?>
                <?php $i++ ?>
                <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img class="group list-group-image img-responsive" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}"></a>
                <div class="caption">
                    <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><h5 class="group inner list-group-item-heading product-name">
                        {{ $product->translate(locale())->name }}</h5></a>
                    <p class="group inner list-group-item-text intro">
                        {{ $product->translate(locale())->description }} </p>
                    <div class="product-footer bottom-right">
                        @can('update-product', $product)
                            <div class="pull-right">
                                <a href={{route('frontend.tradevillage.products.edit', [$product->id])}}><span class="glyphicon glyphicon-pencil"></span></a>
                                <button class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('frontend.tradevillage.products.destroy', [$product->id]) }}"><span class="glyphicon glyphicon-trash"></span></button>
                            </div>
                        @endcan
                        <p class="blue-text">{{ trans('tradevillage::products.form.cost') }}:
                            <span class="group inner list-group-item-text intro">
                            {{ $product->cost }} </span> {{ trans('tradevillage::products.unit') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @else
            <?php break; ?>
        @endif
    @endforeach
@else
    @foreach($category->products as $product)
        @if($i<8)
            @if(isset($current_product) && $product->id == $current_product->id)
                <?php continue; ?>
            @else
                <div class="item col-md-3 col-sm-4 col-xs-6">
                    <div class="thumbnail">
                        <?php $image_direct = public_path().$product->images ?>
                        <a href="{{ route('frontend.tradevillage.products.show', [$product->id]) }}"><img class="group list-group-image img-responsive" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}"></a>
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
            @endif
            <?php $i++ ?>
        @elseif($i>=8)
            <?php break; ?>
        @endif

    @endforeach
    
    @if($i==0)
        {{ trans('tradevillage::products.no product') }}
    @endif
@endif