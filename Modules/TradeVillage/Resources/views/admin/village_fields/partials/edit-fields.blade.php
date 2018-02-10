<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::village_fields.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name", $village_fields->translate($lang)->name), ["class" => "form-control", "placeholder" => trans("tradevillage::village_fields.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::village_fields.form.description")) !!}
        
        {!! Form::text("{$lang}[description]", old("{$lang}.description", $village_fields->translate($lang)->description), ["class" => "form-control", "placeholder" => trans("tradevillage::village_fields.form.description")]) !!}
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
</div>
