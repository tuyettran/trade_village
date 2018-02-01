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

    <div class="form-group{{ $errors->has("chapter") ? " has-error" : "" }}">
        {!! Form::label("chapter", trans("tradevillage::documents.form.chapter")) !!}
        
        {!! Form::number("chapter", old("chapter", $documents->chapter), ["class" => "form-control", "placeholder" => trans("tradevillage::documents.form.chapter")]) !!}
        
        {!! $errors->first("{$lang}.chapter", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("chapter") ? " has-error" : "" }}">
        {!! Form::label("course_id", trans("tradevillage::documents.form.course_name")) !!}
        
        {!! Form::select('course_id', array('1' => 'Large', '2' => 'Small'), old("course_id", $documents->course_id)); !!}
        
        {!! $errors->first("{$lang}.course_id", '<span class="help-block">:message</span>') !!}
    </div>

    <!-- ckeditor -->
    @editor("content", trans("tradevillage::documents.form.content"), old("{$lang}.content", $documents->translate($lang)->title), $lang)

</div>
