<?php $lang=locale() ?>
    <div class="form-group{{ $errors->has("{$lang}.name") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[name]", trans("tradevillage::products.form.name")) !!}
            
        {!! Form::text("{$lang}[name]", old("{$lang}.name", $product->translate($lang)->name), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.name")]) !!}
            
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.description") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[description]", trans("tradevillage::products.form.description")) !!}
            
        {!! Form::textarea("{$lang}[description]", old("{$lang}.description", $product->translate($lang)->description), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.description")]) !!}
            
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.detail") ? " has-error" : "" }}">

        {!! $errors->first("{$lang}.detail", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("{$lang}.material") ? " has-error" : "" }}">
        {!! Form::label("{$lang}[material]", trans("tradevillage::products.form.material")) !!}
            
        {!! Form::text("{$lang}[material]", old("{$lang}.material", $product->translate($lang)->material), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.material")]) !!}
            
        {!! $errors->first("{$lang}.material", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("cost") ? " has-error" : "" }}">
        {!! Form::label("cost", trans("tradevillage::products.form.cost")) !!}
            
        {!! Form::text("cost", old("cost", $product->cost), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.cost")]) !!}
            
        {!! $errors->first("cost", '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group{{ $errors->has("images") ? " has-error" : "" }}">
        {!! Form::label("model", trans("tradevillage::products.form.images")) !!}
            
        <input type="file" name="image[]" id="images" multiple />
        @if(isset($images))
            <div class="row" id="image_preview">
                @foreach( $images as $image)
                    <div class="col-md-2 col-xs-4">
                        <img src="{{ URL::asset(substr($image, 7)) }}" class="img-responsive thumbnail">
                    </div>
                @endforeach
            </div>
        @endif
            
        {!! $errors->first("images", '<span class="help-block">:message</span>') !!}

        <div class="row" id="image_preview"></div>
    </div>
    <div class="form-group{{ $errors->has("3D_image") ? " has-error" : "" }}">
        {!! Form::label("model", trans("tradevillage::products.form.model")) !!}
        <br /> 
        @if(isset($files))
            <div class="files-list">
                &ensp;&ensp;({{count($files)}} files)
                <a class="btn btn-danger delete-model-btn btn-xs">Delete X</a>
                <input type="text" name="delete_model" id="delete_model" hidden>
                <br />
                <div>
                    <ul>
                        @foreach( $files as $file)
                            <li>{{$file}}</li>
                            <br />
                        @endforeach
                    </ul>
                </div>
            </div>
            <input type="file" name="file[]" id="file-1" multiple disabled/>
        @else
            <input type="file" name="file[]" id="file-2" multiple/>
        @endif
        {!! $errors->first("model", '<span class="help-block">:message</span>') !!}    
    </div>