<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[title]", trans("tradevillage::processes.form.title")) !!}
        
        {!! Form::text("{$lang}[title]", old("{$lang}.title"), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.title")]) !!}
        
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("product_id") ? " has-error" : "" }}">
        {!! Form::label("product_id", trans("tradevillage::processes.form.product")) !!}
        <br/>
        <select name="product_id">
        @if( isset($products))
            @foreach( $products as $product)
                @if( $product->locale == $lang)
                    <option value={{$product->products_id}}>{{$product->name}}</option>
                @endif
            @endforeach
        @endif
        </select>
        {!! $errors->first("product", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::processes.form.description")) !!}
        
        {!! Form::text("{$lang}[description]", old("{$lang}.description"), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.description")]) !!}
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("step") ? " has-error" : "" }}">
        {!! Form::label("step", trans("tradevillage::processes.form.step")) !!}
        
        {!! Form::text("step", old("step"), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.step")]) !!}
        
        {!! $errors->first("step", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("image") ? " has-error" : "" }}">
        {!! Form::label("image", trans("tradevillage::processes.form.image")) !!}
        
        {!! Form::text("image", old("image"), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.image")]) !!}
        
        {!! $errors->first("image", '<span class="help-block">:message</span>') !!}
    </div>
</div>
