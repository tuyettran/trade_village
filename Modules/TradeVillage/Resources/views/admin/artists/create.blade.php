@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('tradevillage::artists.title.create artist') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.tradevillage.artist.index') }}">{{ trans('tradevillage::artists.title.artists') }}</a></li>
        <li class="active">{{ trans('tradevillage::artists.title.create artist') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tradevillage.artist.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tradevillage::admin.artists.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="box-body">
                        <div class="form-group{{ $errors->has("date_of_birth") ? " has-error" : "" }}">
                            {!! Form::label("date_of_birth", trans("tradevillage::artists.form.date_of_birth")." ( yyyy-mm-dd )") !!}
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="date_of_birth" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            {!! $errors->first("date_of_birth", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("user_id") ? " has-error" : "" }}">
                            {!! Form::label("user_id", trans("tradevillage::artists.form.user")) !!} 
                                <select name="user_id">
                                    <option value="">--None--</option>
                                    @if( isset($users))
                                    @foreach( $users as $user)
                                        <option value={{$user->id}}>{{$user->first_name}} {{$user->last_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            {!! $errors->first("user_id", '<span class="help-block">:message</span>') !!}
                        </div>
                        @mediaSingle('feature_image')
                        <div class="form-group{{ $errors->has("contact") ? " has-error" : "" }}">
                            {!! Form::label("contact", trans("tradevillage::artists.form.contact")) !!}
                                
                            {!! Form::text("contact", old("contact"), ["class" => "form-control", "placeholder" => trans("tradevillage::artists.form.contact")]) !!}
                                
                            {!! $errors->first("contact", '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group{{ $errors->has("village_id") ? " has-error" : "" }}">
                            {!! Form::label("village_id", trans("tradevillage::artists.form.village")) !!}
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
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.tradevillage.artist.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.tradevillage.artist.index') ?>" }
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
            $(".date").datetimepicker({
                format:'YYYY-MM-DD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                defaultDate: new Date('1970-01-01')
            });
        });
    </script>
@endpush
