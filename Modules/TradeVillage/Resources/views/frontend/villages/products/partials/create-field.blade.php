    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::products.form.name")) !!}
            
        {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.name")]) !!}
            
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::products.form.description")) !!}
            
        {!! Form::textarea("{$lang}[description]", old("{$lang}.description"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.description")]) !!}
            
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.detail") ? " has-error" : "" }}">
        {!! Form::i18nTextarea("detail", trans("tradevillage::products.form.detail"), $errors, $lang, ['id' => 'editor1']) !!}
        
        {!! $errors->first("{$lang}.detail", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.material") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[material]", trans("tradevillage::products.form.material")) !!}
            
        {!! Form::text("{$lang}[material]", old("{$lang}.material"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.material")]) !!}
            
        {!! $errors->first("{$lang}.material", '<span class="help-block">:message</span>') !!}
    </div>