<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
	    {!! Form::label("{$lang}[name]", trans("tradevillage::artists.form.name")) !!}
	        
	    {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::artists.form.name")]) !!}
	        
	    {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
	</div>
	<div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
		{!! Form::label("{$lang}[description]", trans("tradevillage::artists.form.description")) !!}
	        
	    {!! Form::text("{$lang}[description]", old("{$lang}.description"), ["class" => "form-control", "placeholder" => trans("tradevillage::artists.form.description")]) !!}

		{!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
	</div>
	<div class="form-group{{ $errors->has("{$lang}.detail") ? " has-error" : "" }}">
		@editor("{$lang}[detail]", trans("tradevillage::artists.form.detail"), old("{$lang}.detail"))

		{!! $errors->first("{$lang}.detail", '<span class="help-block">:message</span>') !!}
	</div>
	<div class="form-group{{ $errors->has("{$lang}.address") ? " has-error" : "" }}">
	    {!! Form::label("{$lang}[address]", trans("tradevillage::artists.form.address")) !!}
	        
	    {!! Form::text("{$lang}[address]", old("{$lang}.address"), ["class" => "form-control", "placeholder" => trans("tradevillage::artists.form.address")]) !!}
	        
	    {!! $errors->first("{$lang}.address", '<span class="help-block">:message</span>') !!}
	</div>
</div>
