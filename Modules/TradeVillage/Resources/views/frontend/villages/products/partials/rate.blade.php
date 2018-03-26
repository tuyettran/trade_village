<div class="rate">
	<p class="blue-text"><b>{{ mb_strtoupper(trans('tradevillage::products.rate'), 'UTF-8') }} ( <span id="rate_avg">{{ round($product->rate,1) }}</span><span class="glyphicon glyphicon-star"></span>)</b></p>
	<h4 class="flash-hidden alert alert-success">You have just rated for this product!</h4>
	@if(Auth::user())
		<input type="number" name="value" id="rating-product" class="rating rate-element orange-text"  value="{{ $rate }}"/>
	@else
		<input type="number" name="your_awesome_parameter" id="rating-readonly" class="rating rate-element orange-text"  value="{{ $rate }}" data-readonly/>
	@endif
</div>