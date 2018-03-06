@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productIndex.css') }}">
@stop

@section('content')
	<div class="row filter-search-box">
		<div class="col-md-3 pull-right">
			<form class="navbar-form pull-right search-form" role="search">
		        <div class="input-group add-on">
		            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search product') }}" name="srch-term" id="srch-term" type="text">
		            <div class="input-group-btn">
		                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		    </form>
		</div>
		<div class="col-md-9 filter">
			@include('tradevillage::frontend.education.partials.filter', ['categories' => $categories])
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				   	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				   	<li data-target="#myCarousel" data-slide-to="1"></li>
				</ol>
	            <div class="carousel-inner">
	            	<?php $i = 0 ?>
		            @if(isset($images))
		            	@foreach($images as $image)
		            		<div class="item {{ $i==0 ? 'active' : ''}}">
		            			<a href="#"><img class="group list-group-image img-responsive" src="{{ URL::asset(substr($image,7)) }}"></a>
		            		</div>
		            		<?php $i++ ?>
		            	@endforeach
		            @endif
		        </div>
		        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				</a>
	        </div>
        </div>
	</div>
@stop

@section('scripts')
	
<script type="text/javascript">
    $("#images").change(function(){
        $('#image_preview').html("");
        var total_file=document.getElementById("images").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append("<div class=' col-md-2 col-xs-4'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive thumbnail medium-thumbnail' ></div>");
        }
        $(".delete-model-btn").click(function(){
            $("#file-1").prop("disabled", false);
            $(".files-list").hide();
            $("#delete_model").val("yes");
        });
    });
    $('.carousel').carousel({
	  	interval: false
	});
</script>
@stop