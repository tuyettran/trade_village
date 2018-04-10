@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productIndex.css') }}">

@stop

@section('content')
	<div class="row">
        @if(isset($user_id) && $user_id == $currentUser->id)
            <div class="row">
                <div class="col-md-3 pull-right">
                    <a href="{{ route('frontend.tradevillage.products.create') }}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-plus"></span> {{ trans('tradevillage::products.form.add_new') }}</a>
                </div>
            </div>
        @endif
        {!! Form::open(['route' => ['frontend.tradevillage.search.product'], 'method' => 'get', 'id' => 'filter-search-form']) !!}
		<div class="col-md-3 pull-right search-form-sidebar">
			<div class="row">
                <div class="col-md-12 pull-right">
                        <div class="input-group add-on">
                            <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search product') }}" name="search" id="srch-term" type="text">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                </div>
            </div>
		</div>

        @if(!isset($village))
            <div class="col-md-9 filter">
                @if(isset($category) && isset($favorite))
                    @include('tradevillage::frontend.villages.products.partials.filter', ['categories' => $categories, 'category' => $category, 'favorite' => $favorite])
                @else
                    @include('tradevillage::frontend.villages.products.partials.filter', ['categories' => $categories])
                @endif
            </div>
        @else
            <div class="col-md-9">
                <h4><a href="">{{ $village->translate(locale())->name }}</a> > Products</h4>
            </div>
        @endif
        {!! Form::close() !!}
		
		
	</div>
	
	<div class="row">
        @if(isset($categories))
            <div class="{{ isset($user_id)? 'col-md-10 col-sm-12':'col-md-9 col-sm-12' }}">
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
        @else
            <div class="col-md-9 col-sm-12">
                <div class="row">
                    <div class="categories-item">
                        <div id="products" class="row">
                            <div class="list-group">
                                @include('tradevillage::frontend.villages.products.partials.village_products', ['products' => $products ])
                            </div>
                        </div>
                    </div>
                </div>
                {{ $products->links() }}
            </div>
        @endif

        @if(!isset($user_id))
        <div class="col-md-3 col-sm-12">
        	@include('tradevillage::frontend.villages.products.partials.sidebar')
        </div>
        @endif
	</div>
	@include('tradevillage::frontend.villages.delete_modal')
@stop

@section('scripts')
	
<script type="text/javascript">
    $('.nav-products').addClass("active-nav");

    $( document ).ready(function() {
        $('#category_select').change(function(){
            $('#filter-search-form').submit();
        })
        $('#favorite_select').change(function(){
            $('#filter-search-form').submit();
        })
    });

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