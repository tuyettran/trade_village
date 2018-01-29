<div class="box-body">
    <div class="form-group{{ $errors->has("{$lang}.title") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[title]", trans("tradevillage::processes.form.title")) !!}
        
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $process->translate(locale())->title), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.title")]) !!}
        
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("product_id") ? " has-error" : "" }}">
        {!! Form::label("product_id", trans("tradevillage::processes.form.product")) !!}
        <br/>
        <select name="product_id">
        @if( isset($products))
            @foreach( $products as $product)
                @if( $product->locale == $lang)
                    @if( $product->products_id == $process->product_id)
                        <option value={{$product->products_id}} selected>{{$product->name}} </option>
                    @else
                        <option value={{$product->products_id}}>{{$product->name}} </option>
                    @endif
                @endif
            @endforeach
        @endif
        </select>
        
        {!! $errors->first("product_id", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::processes.form.description")) !!}
        
        {!! Form::text("{$lang}[description]", old("{$lang}.description", $process->translate(locale())->description), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.description")]) !!}
        
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("step") ? " has-error" : "" }}">
        {!! Form::label("step", trans("tradevillage::processes.form.step")) !!}
        
        {!! Form::number("step", old("step", $process->step), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.step")]) !!}
        
        {!! $errors->first("{$lang}.step", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("image") ? " has-error" : "" }}">
        {!! Form::label("image", trans("tradevillage::processes.form.image")) !!}
        
        {!! Form::text("image", old("image", $process->image), ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.image")]) !!}
        
        {!! $errors->first("{$lang}.image", '<span class="help-block">:message</span>') !!}
    </div>
</div>
