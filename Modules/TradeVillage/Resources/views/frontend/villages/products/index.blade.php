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
		<div class="col-md-9 col-sm-12">
            @foreach ($categories as $category)
				<div class="row">
					<div class="categories-item">
						<a href="#"><h4 class="text">{{ mb_strtoupper($category->translate(locale())->name, "UTF-8") }}</h4></a>
	               		<div id="products" class="row">
	               			<div class="list-group">
	               				@include('tradevillage::frontend.villages.products.partials.product', ['category' => $category])
	               			</div>
	                    </div>
					</div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3 col-sm-12">
        	@include('tradevillage::frontend.villages.products.partials.sidebar')
        </div>
	</div>
	@include('core::partials.delete-modal')
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
</script>
@stop