<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::lessons.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::lessons.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>

    @editor("description", trans("tradevillage::lessons.form.description"), old("{$lang}.description"), $lang)

    <div class="form-group{{ $errors->has("course_id") ? " has-error" : "" }}">
        {!! Form::label("course_id", trans("tradevillage::lessons.form.course_id")) !!} 
            <select name="course_id">
                @if( isset($courses))
                @foreach( $courses as $course)
                    @if( $course->locale == $lang)
                        <option value={{$course->courses_id}}>{{$course->name}}</option>
                    @endif
                @endforeach
                @endif
            </select>
        {!! $errors->first("course_id", '<span class="help-block">:message</span>') !!}
    </div>
</div>
