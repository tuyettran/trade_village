<div class="item col-md-3 col-sm-4 col-xs-6">
    <div class="thumbnail">
    	
    	<img class="group list-group-image" src="../assets/images/san-pham/02.jpg" alt=""/>
        <div class="caption">
            @can('update-product', $product)
                <a href="/product/{{ $product->id }}/edit">Edit Post</a>
            @endcan
            <a href="#"><h5 class="group inner list-group-item-heading product-name">
                {{ $product->translate(locale())->name }}</h5></a>
            <p class="group inner list-group-item-text intro">
            {{ $product->translate(locale())->description }} </p><a href="#"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
        </div>
    </div>
</div>