@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::products.title.create products') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.products.index') }}">{{ trans('tradevillage::products.title.products') }}</a></li>
        <li class="active">{{ trans('tradevillage::products.title.create products') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.products.store'], 'method' => 'post', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.products.partials.create-fields', ['lang' => $locale])
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
                                            <option value={{$artist->artist_id}}>{{$artist->name}}</option>
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
                                            <option value={{$enterprise->enterprises_id}}>{{$enterprise->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            {!! $errors->first("enterprise_id", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("cost") ? " has-error" : "" }}">
                            {!! Form::label("cost", trans("tradevillage::products.form.cost")) !!}
                                
                            {!! Form::text("cost", old("cost"), ["class" => "form-control", "placeholder" => trans("tradevillage::products.form.cost")]) !!}
                                
                            {!! $errors->first("cost", '<span class="help-block">:message</span>') !!}
                        </div>
                        @mediaMultiple('images')
                        <div class="form-group{{ $errors->has("3D_image") ? " has-error" : "" }}">
                            {!! Form::label("model", trans("tradevillage::products.form.model")) !!}
                                
                            <input type="file" name="file[]" id="file" multiple />
                                
                            {!! $errors->first("model", '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
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
@endpush
