<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
	    {!! Form::label("{$lang}[name]", trans("tradevillage::artists.form.name")) !!}
	        
	    {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::artists.form.name")]) !!}
	        
	    {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
	</div>
	@editor("{$lang}[description]", trans("tradevillage::artists.form.description"), old("{$lang}.description", $lang))
	@editor("{$lang}[detail]", trans("tradevillage::artists.form.detail"), old("{$lang}.detail", $lang))
	<div class="form-group{{ $errors->has("{$lang}.address") ? " has-error" : "" }}">
	    {!! Form::label("{$lang}[address]", trans("tradevillage::artists.form.address")) !!}
	        
	    {!! Form::text("{$lang}[address]", old("{$lang}.address"), ["class" => "form-control", "placeholder" => trans("tradevillage::artists.form.address")]) !!}
	        
	    {!! $errors->first("{$lang}.address", '<span class="help-block">:message</span>') !!}
	</div>
</div>
