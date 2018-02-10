<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[title]", trans("tradevillage::news.form.title")) !!}
        
        {!! Form::text("{$lang}[title]", old("{$lang}.title"), ["class" => "form-control", "placeholder" => trans("tradevillage::news.form.title")]) !!}
        
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    @editor("content", trans("tradevillage::news.form.content"), old("{$lang}.content"), $lang)

    <div class="form-group{{ $errors->has("village_id") ? " has-error" : "" }}">
        {!! Form::label("village_id", trans("tradevillage::news.form.village")) !!}
        <br/>
        <select name="village_id">
        @if( isset($villages))
            @foreach( $villages as $village)
                @if( $village->locale == $lang)
                    <option value={{$village->villages_id}}>{{$village->name}}</option>
                @endif
            @endforeach
        @endif
        </select>
        {!! $errors->first("village_id", '<span class="help-block">:message</span>') !!}
    </div>
</div>
