@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productIndex.css') }}">

@stop

@section('content')
	<div class="row">
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

        <div class="col-md-9 filter">
            @include('tradevillage::frontend.villages.products.partials.filter', ['categories' => $categories, 'category' => $category, 'favorite' => $favorite])
        </div>

        {!! Form::close() !!}
	</div>
	
	<div class="row">
        <h4><a href="{{ route('frontend.tradevillage.news.index') }}"><b>{{ trans('tradevillage::main.filter.product') }}</b></a> {{ '> '.$category->translate(locale())->name }}</h4>
        <hr>
        <div class="col-md-10 col-sm-12">
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
	</div>
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
</script>
@stop