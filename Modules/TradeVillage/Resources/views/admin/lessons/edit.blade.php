@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::lessons.title.edit lessons') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.lessons.index') }}">{{ trans('tradevillage::lessons.title.lessons') }}</a></li>
        <li class="active">{{ trans('tradevillage::lessons.title.edit lessons') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.lessons.update', $lessons->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.lessons.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        <div class="form-group{{ $errors->has("refer_doc") ? " has-error" : "" }}">
                            {!! Form::label("refer_doc", trans("tradevillage::lessons.form.refer_doc")) !!}
                            
                            {!! Form::textarea("refer_doc", old("refer_doc", $lessons->refer_doc), ["class" => "form-control", "placeholder" => trans("tradevillage::lessons.form.refer_doc")]) !!}
                            
                            {!! $errors->first("refer_doc", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("refer_video") ? " has-error" : "" }}">
                            {!! Form::label("refer_video", trans("tradevillage::lessons.form.refer_video")) !!}
                            
                            {!! Form::textarea("refer_video", old("refer_video", $lessons->refer_video), ["class" => "form-control", "placeholder" => trans("tradevillage::lessons.form.refer_video")]) !!}
                            
                            {!! $errors->first("refer_video", '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.lessons.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.tradevillage.lessons.index') ?>" }
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
