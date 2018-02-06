@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::events.title.edit events') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.events.index') }}">{{ trans('tradevillage::events.title.events') }}</a></li>
        <li class="active">{{ trans('tradevillage::events.title.edit events') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.events.update', $events->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.events.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        @mediaSingle('feature_image', $events)

                        <div class="form-group{{ $errors->has("start_time") ? " has-error" : "" }}">
                            {!! Form::label("start_time", trans("tradevillage::events.form.start_time")." ( yyyy-mm-dd hh:mm )") !!}
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="start_time" value="{{$events->start_time}}" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            {!! $errors->first("start_time", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("end_time") ? " has-error" : "" }}">
                            {!! Form::label("end_time", trans("tradevillage::events.form.end_time")." ( yyyy-mm-dd hh:mm )") !!}
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" name="end_time" value="{{$events->end_time}}" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            {!! $errors->first("end_time", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("village_id") ? " has-error" : "" }}">
                            {!! Form::label("village_id", trans("tradevillage::events.form.village")) !!}
                            <select name="village_id">
                            @if( isset($villages))
                                @foreach( $villages as $village)
                                    @if( $village->locale == locale())
                                        <option value={{$village->villages_id}}>{{$village->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                            </select>
                            {!! $errors->first("village_id", '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.events.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.tradevillage.events.index') ?>" }
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
        $(function () {
            $("#datetimepicker2").datetimepicker({
                format:'YYYY-MM-DD HH:mm',
                sideBySide : true,  
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                defaultDate: new Date()
            });
            $("#datetimepicker1").datetimepicker({
                format:'YYYY-MM-DD HH:mm',
                sideBySide : true,  
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                defaultDate: new Date()
            });
        });
    </script>
@endpush
