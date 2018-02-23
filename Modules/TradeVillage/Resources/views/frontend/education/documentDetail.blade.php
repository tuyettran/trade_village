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
			<a><h3>{{ $document->title }}</h3></a>
	        <div class="pull-right">
	        	<table>
	        		<tr>
	        			<th>Course: </th>
	        			<th><h4><a>{{ $document->course->translate(locale())->name }}</a></h4></th>
	        		</tr>
	        		<tr>
	        			<th>Author: </th>
	        			<th><h5><a>{{ $document->translate(locale())->author }}</a></h5></th>
	        		</tr>
	        	</table>
	        </div>
	        <h1>{{ $pdf }} àae</h1>
	        <iframe src="http://langnghe.dev:8000/storage/public/Luan van.pdf" width="50%" height="500" alt="pdf" type="application/pdf"></iframe>
		</div>
	</div>
@stop

@section('scripts')
@stop