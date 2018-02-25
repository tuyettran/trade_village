@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::products.title.edit products') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.products.index') }}">{{ trans('tradevillage::products.title.products') }}</a></li>
        <li class="active">{{ trans('tradevillage::products.title.edit products') }}</li>
    </ol>
@stop
@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.products.update', $products->id], 'method' => 'put', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.products.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        <div class="form-group{{ $errors->has("artist_id") ? " has-error" : "" }}">
                            {!! Form::label("village_id", trans("tradevillage::products.form.artist")) !!}
                            <select name="artist_id">
                                <option value="">---</option>
                                @if( isset($artists))
                                    @foreach( $artists as $artist)
                                        @if( $artist->locale == locale())
                                            @if( $artist->artist_id == $products->artist_id)
                                                <option value={{$artist->artist_id}} selected>{{$artist->name}}</option>
                                            @else
                                                <option value={{$artist->artist_id}}>{{$artist->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            {!! $errors->first("artist_id", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("enterprise_id") ? " has-error" : "" }}">
                            {!! Form::label("enterprise_id", trans("tradevillage::products.form.enterprise")) !!}
                            <select name="enterprise_id">
                                <option value="">---</option>
                                @if( isset($enterprises))
                                    @foreach( $enterprises as $enterprise)
                                        @if( $enterprise->locale == locale())
                                            @if( $enterprise->enterprises_id == $products->enterprise_id)
                                                <option value={{$enterprise->enterprises_id}} selected>{{$enterprise->name}}</option>
                                            @else
                                                <option value={{$enterprise->enterprises_id}}>{{$enterprise->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            {!! $errors->first("enterprise_id", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("cost") ? " has-error" : "" }}">
                            {!! Form::label("cost", trans("tradevillage::products.form.cost")) !!}
                                
                            {!! Form::text("cost", old("cost", $products->cost), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.cost")]) !!}
                                
                            {!! $errors->first("cost", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("cost") ? " has-error" : "" }}">
                            {!! Form::label("cost", trans("tradevillage::products.form.images")) !!}
                            <input type="file" name="image[]" id="images" multiple />
                            <div class="row" id="image_preview">
                                @if(isset($images))
                                    @foreach( $images as $image)
                                        <div class="col-md-2 col-xs-4">
                                            <img src="{{ URL::asset(substr($image, 7)) }}" class="img-responsive thumbnail">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        <div class="form-group{{ $errors->has("model") ? " has-error" : "" }}">
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
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.products.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.tradevillage.products.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $(".delete-model-btn").click(function(){
                $("#file-1").prop("disabled", false);
                $(".files-list").hide();
                $("#delete_model").val("yes");
            });
            $("#images").change(function(){
                $('#image_preview').html("");
                var total_file=document.getElementById("images").files.length;
                for(var i=0;i<total_file;i++)
                {
                    $('#image_preview').append("<div class=' col-md-2 col-xs-4'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive thumbnail medium-thumbnail' ></div>");
                }
            });
        });
    </script>
@endpush
