<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::enterprises.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name", $enterprises->translate($lang)->name), ["class" => "form-control", "placeholder" => trans("tradevillage::enterprises.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::enterprises.form.description")) !!}
        
        {!! Form::text("{$lang}[description]", old("{$lang}.description", $enterprises->translate($lang)->description), ["class" => "form-control", "placeholder" => trans("tradevillage::enterprises.form.description")]) !!}
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>

     @editor("detail", trans("tradevillage::enterprises.form.detail"), old("{$lang}.detail", $enterprises->translate($lang)->detail), $lang)

    <div class="form-group{{ $errors->has("village_id") ? " has-error" : "" }}">
        {!! Form::label("village_id", trans("tradevillage::enterprises.form.village")) !!} 
            <select name="village_id">
                @if( isset($villages))
                @foreach( $villages as $village)
                    @if( $village->locale == $lang)
                        @if( $village->villages_id == $enterprises->village_id)
                            <option value={{$village->villages_id}} selected>{{$village->name}}</option>
                        @else
                            <option value={{$village->villages_id}}>{{$village->name}}</option>
                        @endif
                    @endif
                @endforeach
                @endif
            </select>
        {!! $errors->first("village_id", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("{$lang}.address") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[address]", trans("tradevillage::enterprises.form.address")) !!}
        
        {!! Form::text("{$lang}[address]", old("{$lang}.address", $enterprises->translate($lang)->address), ["id" => "address", "class" => "form-control", "placeholder" => trans("tradevillage::enterprises.form.address")]) !!}
        
        {!! $errors->first("{$lang}.address", '<span class="help-block">:message</span>') !!}
    </div>
</div>
