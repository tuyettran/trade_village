@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/documentIndex.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/educateIndex.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/videoDetail.css') }}">

@stop

@section('content')
	<div class="row">
		<div class="row search-form">
			<form>
				<input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm ..." class="pull-right col-md-4">
			</form>
		</div>
		<div class="col-md-3 col-xs-12 side-bar">
			@include('tradevillage::frontend.education.partials.courseDetailSidebar', ['lang' => locale()])
		</div>
		<div class="col-md-9 col-xs-12 main-content">
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
			{{ $documents->links() }}
		</div>
	</div>
@stop

@section('scripts')
@stop