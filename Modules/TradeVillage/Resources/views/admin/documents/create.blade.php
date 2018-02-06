@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::documents.title.create documents') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.documents.index') }}">{{ trans('tradevillage::documents.title.documents') }}</a></li>
        <li class="active">{{ trans('tradevillage::documents.title.create documents') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.documents.store'], 'method' => 'post', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.documents.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        
                        <div class="form-group{{ $errors->has("course_id") ? " has-error" : "" }}">
                            {!! Form::label("course_id", trans("tradevillage::documents.form.course_name")) !!}
                            <select name="course_id">
                            @if( isset($course))
                                @foreach( $course as $course)
                                    @if( $course->locale == locale())
                                        <option value={{$course->courses_id}}>{{$course->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                            </select>
                            {!! $errors->first("course_id", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("file") ? " has-error" : "" }}">
                            {!! Form::label("file", trans("tradevillage::documents.form.file")) !!}
                            
                            <input type="file" name="file" id="file" />
                            
                            {!! $errors->first("file", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("chapter") ? " has-error" : "" }}">
                            {!! Form::label("chapter", trans("tradevillage::documents.form.chapter")) !!}
                            
                            {!! Form::number("chapter", old("chapter"), ["class" => "form-control", "placeholder" => trans("tradevillage::documents.form.chapter")]) !!}
                            
                            {!! $errors->first("chapter", '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.documents.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.tradevillage.documents.index') ?>" }
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
