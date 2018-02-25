<?php $lang=locale() ?>
<div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
    {!! Form::label("{$lang}[name]", trans("tradevillage::products.form.name")) !!}
        
    {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.name")]) !!}
        
    {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
    {!! Form::label("{$lang}[description]", trans("tradevillage::products.form.description")) !!}
        
    {!! Form::text("{$lang}[description]", old("{$lang}.description"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.description")]) !!}
        
    {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has("{$lang}.detail") ? " has-error" : "" }}">

    {!! $errors->first("{$lang}.detail", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has("{$lang}.material") ? " has-error" : "" }}">
    {!! Form::label("{$lang}[material]", trans("tradevillage::products.form.material")) !!}
        
    {!! Form::text("{$lang}[material]", old("{$lang}.material"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.material")]) !!}
        
    {!! $errors->first("{$lang}.material", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has("cost") ? " has-error" : "" }}">
    {!! Form::label("cost", trans("tradevillage::products.form.cost")) !!}
        
    {!! Form::text("cost", old("cost"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.cost")]) !!}
        
    {!! $errors->first("cost", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has("images") ? " has-error" : "" }}">
    {!! Form::label("model", trans("tradevillage::products.form.images")) !!}
        
    <input type="file" name="images[]" id="images" multiple />
        
    {!! $errors->first("images", '<span class="help-block">:message</span>') !!}

    <div class="row" id="image_preview"></div>
</div>
<div class="form-group{{ $errors->has("3D_image") ? " has-error" : "" }}">
    {!! Form::label("model", trans("tradevillage::products.form.model")) !!}
        
    <input type="file" name="file[]" id="file" multiple />
        
    {!! $errors->first("model", '<span class="help-block">:message</span>') !!}
</div>