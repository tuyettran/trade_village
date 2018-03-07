<div class="rate">
	<p class="blue-text"><b>{{ mb_strtoupper(trans('tradevillage::products.rate'), 'UTF-8') }} ({{ count($product->rates) }} {{ trans('tradevillage::products.rate') }})</b></p>
	
	@if(Auth::user())
		<input type="number" name="your_awesome_parameter" id="rating-readonly" class="rating rate-element orange-text"  value="{{ round($rate_average) }}"/>
	@else
		<input type="number" name="your_awesome_parameter" id="rating-readonly" class="rating rate-element orange-text"  value="{{ round($rate_average) }}" data-readonly/>
	@endif
</div>