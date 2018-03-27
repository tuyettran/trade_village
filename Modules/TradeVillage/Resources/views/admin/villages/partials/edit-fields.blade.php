<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::villages.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name", $villages->translate($lang)->name), ["class" => "form-control", "placeholder" => trans("tradevillage::villages.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>
    
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::villages.form.description")) !!}
        
        {!! Form::text("{$lang}[description]", old("{$lang}.description", $villages->translate($lang)->description), ["class" => "form-control", "placeholder" => trans("tradevillage::villages.form.description")]) !!}
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
        
    @editor("story", trans("tradevillage::villages.form.story"), old("{$lang}.story", $villages->translate($lang)->story), $lang)
    @editor("detail", trans("tradevillage::villages.form.detail"), old("{$lang}.detail", $villages->translate($lang)->detail), $lang)

</div>
