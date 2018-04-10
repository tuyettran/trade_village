<div class="rate">
	<p class="blue-text"><b>{{ mb_strtoupper(trans('tradevillage::products.rate'), 'UTF-8') }} ( <span id="rate_avg">{{ round($product->rate,1) }}</span><span class="glyphicon glyphicon-star"></span>)</b></p>
	<h4 class="flash-hidden alert alert-success">{{ trans('tradevillage::products.have_just_rated') }}!</h4>
	<p>( <span class="rates-number">{{ count($product->rates)}} </span> <span>{{ trans('tradevillage::products.rate') }} )</span></p>
	@if(Auth::user())
		<input type="number" name="value" id="rating-product" class="rating rate-element orange-text"  value="{{ $rate }}"/>
	@else
		<input type="number" name="value" id="rating-product" class="rating rate-element orange-text"  value="{{ $rate }}" data-readonly/>
	@endif
</div>