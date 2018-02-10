<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[title]", trans("tradevillage::links.form.title")) !!}
        
        {!! Form::text("{$lang}[title]", old("{$lang}.title"), ["class" => "form-control", "placeholder" => trans("tradevillage::links.form.title")]) !!}
        
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("village_id") ? " has-error" : "" }}">
        {!! Form::label("village_id", trans("tradevillage::links.form.village")) !!}
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
