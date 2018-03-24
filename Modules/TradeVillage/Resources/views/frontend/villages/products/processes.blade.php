@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/process.css') }}">
@stop

@section('content')
	<div class="row processes">
		<div class="col-md-7 col-xs-9 info">
			<div class="pull-right">
				@if($product->enterprise)
					<h4><b>{{ trans('tradevillage::products.enterprise') }}: <a href="#">{{ $product->enterprise->translate(locale())->name}}</a></b></h4>
					
					<p class="pull-right"><b>{{ trans('tradevillage::products.address') }}:</b> {{ $product->enterprise->address }}</p>
					<p class="pull-right"><b>{{ trans('tradevillage::products.title.contact') }}:</b> {{ $product->enterprise->contact}}</p>
					<p class="pull-right"><b>Website:</b> {{ $product->enterprise->website }}</p>
			    @elseif($product->artist)
			    	<h4><b>{{ trans('tradevillage::products.artist') }}: <a href="{{ route('frontend.tradevillage.artist.show', [$product->artist->id]) }}">{{ $product->artist->translate(locale())->name}}</a></b></h4>
			        
					<p class="pull-right"><b>{{ trans('tradevillage::products.address') }}:</b> {{ $product->artist->translate(locale())->address}}</p>
					<p class="pull-right"><b>{{ trans('tradevillage::products.title.contact') }}:</b> {{ $product->artist->contact}}</p>
				@endif
			</div>
		</div>
		<div class="col-md-5 col-xs-12 background">
			<div class="row">
				<div class="col-md-4 col-xs-4 image">
					<?php $image_direct = public_path().$product->images ?>
		            <img class="img-responsive" src="{{ URL::asset($product->images.scandir($image_direct)[2]) }}">
				</div>
				<div class="col-md-8 col-xs-8">
					<h3 class="white-text">{{ trans('tradevillage::products.process_of') }} {{ mb_strtoupper($product->translate(locale())->name, "UTF-8") }} {{ trans('tradevillage::products.manufacture') }}</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="row items">
		<ul>
		@foreach($processes as $process)
			<li>
				<div class="process row">
					<div class="col-md-4">
						<img src="{{ $process->image }}" class="img-responsive thumbnail process-image" />
					</div>
					<div class="col-md-8 process-content">
						<div class="top-right">
							@can('update-product', $product)
								<a href="{{ route('frontend.tradevillage.process.edit', [$process->id, $product->id]) }}" class="btn btn-primary btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
								<button class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('frontend.tradevillage.process.destroy', [$process->id, $product->id]) }}"><span class="glyphicon glyphicon-trash"></span></button>
							@endcan
						</div>
						<h3><span class="step">{{ $process->step }}</span><b>{{ $process->translate(locale())->title }}</b></h3>
						{!! $process->translate(locale())->description !!}
					</div>
				</div>
			</li>
		@endforeach
		</ul>
		<hr/>
		@can('update-product', $product)
			{!! Form::open(['route' => ['frontend.tradevillage.process.store', $product->id], 'method' => 'post', 'files' => true]) !!}
			    <div class="row form">
			    	<h4><b>{{ trans('tradevillage::products.create_process') }}</b></h4>
			        <div class="col-md-12">
			            <div class="nav-tabs-custom">
			                @include('partials.form-tab-header')
			                <div class="tab-content">
			                    <?php $i = 0; ?>
			                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
			                        <?php $i++; ?>
			                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
			                            @include('tradevillage::frontend.villages.processes.partials.create-field', ['lang' => $locale])
			                        </div>
			                    @endforeach
			                    <div class="box-body">
			                        <div class="form-group{{ $errors->has("step") ? " has-error" : "" }}">
			                            {!! Form::label("step", trans("tradevillage::processes.form.step")) !!}
            
			                            {{ Form::input('number', 'step', old("step"),  ["class" => "form-control", "placeholder" => trans("tradevillage::processes.form.step")]) }}    
			                            {!! $errors->first("cost", '<span class="help-block">:message</span>') !!}
			                        </div>
			                        <div class="form-group{{ $errors->has("process-image") ? " has-error" : "" }}">
			                            {!! Form::label("image", trans("tradevillage::processes.form.image")) !!}
			                            
			                            <input name="process-image" type="file" required>
			                            {!! $errors->first("process-image", '<span class="help-block">:message</span>') !!}
			                        </div>
			                    </div>

			                    <div class="box-footer pull-right ">
			                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
			                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('frontend.tradevillage.products.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
			                    </div>
			                </div>
			            </div> {{-- end nav-tabs-custom --}}
			        </div>
			    </div>
			    {!! Form::close() !!}		
		@endcan
	</div>
	@include('tradevillage::frontend.villages.delete_modal')
@stop

@section('scripts')
<script type="text/javascript">
	$('.nav-products').addClass("active-nav");
	$( document ).ready(function() {
        $('#modal-delete-confirmation').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var actionTarget = button.data('action-target');
            var modal = $(this);
            modal.find('form').attr('action', actionTarget);

            if (button.data('message') === undefined) {
            } else if (button.data('message') != '') {
                modal.find('.custom-message').show().empty().append(button.data('message'));
                modal.find('.default-message').hide();
            } else {
                modal.find('.default-message').show();
                modal.find('.custom-message').hide();
            }

            if (button.data('remove-submit-button') === true) {
                modal.find('button[type=submit]').hide();
            } else {
                modal.find('button[type=submit]').show();
            }
        });
    });
</script>

@stop