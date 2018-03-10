<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::courses.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::courses.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>

    @editor("description", trans("tradevillage::courses.form.description"), old("{$lang}.description"), $lang)

    <div class="form-group{{ $errors->has("{$lang}.author") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[author]", trans("tradevillage::courses.form.author")) !!}
        
        {!! Form::text("{$lang}[author]", old("{$lang}.author"), ["class" => "form-control", "placeholder" => trans("tradevillage::courses.form.author")]) !!}
        
        {!! $errors->first("{$lang}.author", '<span class="help-block">:message</span>') !!}
    </div>
</div>
