<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[title]", trans("tradevillage::processes.form.title")) !!}
        
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $process->translate($lang)->title), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.title")]) !!}
        
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        @editor("{$lang}[description]", trans("tradevillage::processes.form.description"), old("{$lang}.description", $process->translate(locale())->description))
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
</div>
