<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::villages.form.name")) !!}
        
        {!! Form::text("{$lang}[name]", old("{$lang}.name"), ["class" => "form-control", "placeholder" => trans("tradevillage::villages.form.name")]) !!}
        
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>
    
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::villages.form.description")) !!}
        
        {!! Form::text("{$lang}[description]", old("{$lang}.description"), ["class" => "form-control", "placeholder" => trans("tradevillage::villages.form.description")]) !!}
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("{$lang}.address") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[address]", trans("tradevillage::villages.form.address")) !!}
        
        {!! Form::text("{$lang}[address]", old("{$lang}.address"), ["class" => "form-control", "placeholder" => trans("tradevillage::villages.form.address")]) !!}
        
        {!! $errors->first("{$lang}.address", '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group{{ $errors->has("category_id") ? " has-error" : "" }}">
        {!! Form::label("category_id", trans("tradevillage::villages.form.category")) !!} 
            <select name="category_id">
                @if( isset($categories))
                @foreach( $categories as $category)
                    @if( $category->locale == $lang)
                        <option value={{$category->village_fields_id}}>{{$category->name}}</option>
                    @endif
                @endforeach
                @endif
            </select>
        {!! $errors->first("category_id", '<span class="help-block">:message</span>') !!}
    </div>
        
    @editor("story", trans("tradevillage::villages.form.story"), old("{$lang}.story"), $lang)
    @editor("detail", trans("tradevillage::villages.form.detail"), old("{$lang}.detail"), $lang)

</div>
