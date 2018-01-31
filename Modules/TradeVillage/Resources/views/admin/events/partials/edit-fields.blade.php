<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
	    {!! Form::label("{$lang}[title]", trans("tradevillage::events.form.title")) !!}
	        
	    {!! Form::text("{$lang}[title]", old("{$lang}.title", $events->translate($lang)->title), ["class" => "form-control", "placeholder" => trans("tradevillage::events.form.title")]) !!}
	        
	    {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
	</div>
	<div class="form-group{{ $errors->has("{$lang}.address") ? " has-error" : "" }}">
	    {!! Form::label("{$lang}[address]", trans("tradevillage::events.form.address")) !!}
	        
	    {!! Form::text("{$lang}[address]", old("{$lang}.address", $events->translate($lang)->address), ["class" => "form-control", "placeholder" => trans("tradevillage::events.form.address")]) !!}
	        
	    {!! $errors->first("{$lang}.address", '<span class="help-block">:message</span>') !!}
	</div>

	@editor("{$lang}[content]", trans("tradevillage::events.form.content"), old("{$lang}.content", $events->translate($lang)->content))

</div>
