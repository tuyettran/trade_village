<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::courses.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::courses.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>
</div>
