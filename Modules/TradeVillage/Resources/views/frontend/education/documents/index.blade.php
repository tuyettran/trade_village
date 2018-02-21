@extends('layouts.master')

@section('style')
@stop

@section('content')
	@foreach ($documents as $document)
		<ul>
			<li>
				{{ $document->chapter }}
				<a href="{{ route('frontend.tradevillage.documents.index') }}">
		            <h3>{{ $document->title }}</h3>
		        </a>
		        <a href="{{ route('frontend.tradevillage.documents.index') }}">
		        	{{ $document->course->translate(locale())->name }}
		        </a>
		        <a href="{{ route('frontend.tradevillage.documents.index') }}">
		        	{{ $document->translate(locale())->author }}
		        </a>
			</li>
		</ul>
	@endforeach
@stop

@section('scripts')
@stop