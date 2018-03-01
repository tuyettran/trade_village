<div class="box-body">
    <div class="form-group{{ $errors->has("village_id") ? " has-error" : "" }}">
        {!! Form::label("village_id", trans("tradevillage::village_coordinates.form.village")) !!} 
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
