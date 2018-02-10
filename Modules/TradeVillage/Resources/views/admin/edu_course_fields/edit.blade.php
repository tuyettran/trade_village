@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::edu_course_fields.title.edit edu_course_fields') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.edu_course_fields.index') }}">{{ trans('tradevillage::edu_course_fields.title.edu_course_fields') }}</a></li>
        <li class="active">{{ trans('tradevillage::edu_course_fields.title.edit edu_course_fields') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.edu_course_fields.update', $edu_course_field->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="box-body">
                    <div class="form-group{{ $errors->has("course_id") ? " has-error" : "" }}">
                            {!! Form::label("course_id", trans("tradevillage::edu_course_fields.form.course")) !!}
                            <br/>
                            <select name="course_id">
                                @if( isset($courses))
                                    @foreach( $courses as $course)
                                        @if( $course->locale == locale())
                                            @if( $course->courses_id == $edu_course_field->course_id)
                                                <option value={{$course->courses_id}} selected>{{$course->name}}</option>
                                            @else
                                                <option value={{$course->courses_id}}>{{$course->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            
                            {!! $errors->first("course_id", '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group{{ $errors->has("edu_field_id") ? " has-error" : "" }}">
                            {!! Form::label("edu_field_id", trans("tradevillage::edu_course_fields.form.edu_field")) !!}
                            <br/>
                            <select name="edu_field_id">
                                @if( isset($edu_fields))
                                    @foreach( $edu_fields as $edu_field)
                                        @if( $edu_field->locale == locale())
                                            <option value={{$edu_field->edu_fields_id}}>{{$edu_field->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            
                            {!! $errors->first("edu_field_id", '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.edu_course_fields.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.tradevillage.edu_course_fields.index') ?>" }
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
