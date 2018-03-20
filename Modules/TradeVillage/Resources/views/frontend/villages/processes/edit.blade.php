@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/process.css') }}">
@stop

@section('content')
	{!! Form::open(['route' => ['frontend.tradevillage.process.update', $process->id, $product->id], 'method' => 'put', 'files' => true]) !!}
	    <div class="row form">
	    	<h4><b>Edit</b></h4>
	        <div class="col-md-12">
	            <div class="nav-tabs-custom">
	                @include('partials.form-tab-header')
	                <div class="tab-content">
	                    <?php $i = 0; ?>
	                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
	                        <?php $i++; ?>
	                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
	                            @include('tradevillage::frontend.villages.processes.partials.edit-field', ['lang' => $locale])
	                        </div>
	                    @endforeach
	                    <div class="box-body">
	                        <div class="form-group{{ $errors->has("step") ? " has-error" : "" }}">
	                            {!! Form::label("step", trans("tradevillage::processes.form.step")) !!}
    
	                            {{ Form::input('number', 'step', old("step", $process->step),  ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.step")]) }}    
	                            {!! $errors->first("cost", '<span class="help-block">:message</span>') !!}
	                        </div>
	                        <div class="form-group{{ $errors->has("process-image") ? " has-error" : "" }}">

	                            <p>{!! Form::label("image", trans("tradevillage::processes.form.image")) !!}</p>
	                            <div class="process-image-edit">
	                            	<img src="{{ $process->image }}" class="img-responsive thumbnail ">
	                            </div>
	                            {!! Form::file('process-image') !!}
	                            {!! $errors->first("process-image", '<span class="help-block">:message</span>') !!}
	                        </div>
	                    </div>
	                    <div class="box-footer pull-right ">
	                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
	                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('frontend.tradevillage.products.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
	                    </div>
	                </div>
	            </div> {{-- end nav-tabs-custom --}}
	        </div>
	    </div>
	{!! Form::close() !!}
@stop

@section('scripts')
<script type="text/javascript">
	$('.nav-products').addClass("active-nav");
</script>
@stop