<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[title]", trans("tradevillage::documents.form.title")) !!}
        
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $documents->translate($lang)->title), ["class" => "form-control", "placeholder" => trans("tradevillage::documents.form.title")]) !!}
        
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("{$lang}.author") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[author]", trans("tradevillage::documents.form.author")) !!}
        
        {!! Form::text("{$lang}[author]", old("{$lang}.author", $documents->translate($lang)->author), ["class" => "form-control", "placeholder" => trans("tradevillage::documents.form.author")]) !!}
        
        {!! $errors->first("{$lang}.author", '<span class="help-block">:message</span>') !!}
    </div>

    @editor("description", trans("tradevillage::documents.form.description"), old("{$lang}.description", $documents->translate($lang)->description), $lang)
</div>
