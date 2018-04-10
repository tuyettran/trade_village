@extends('layouts.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productIndex.css') }}">
@stop

@section('content')
    <div class="row filter-search-box">
        <div class="col-md-3 pull-right">
            {!! Form::open(['route' => ['frontend.tradevillage.search.product'], 'method' => 'get']) !!}
                <div class="input-group add-on">
                    <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search product') }}" name="search" id="srch-term" type="text">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @if(isset($images))
                        <?php $i=0 ?>
                        @foreach($images as $image)
                            <li data-target="#myCarousel" data-slide-to="{{$i++}}" {{ $i==0? 'active':''}}></li>
                        @endforeach
                    @endif
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
        <div class="col-md-8 col-xs-12">
            <div class="product-infomation">
                <h3 class="orange-text"><b>{{ mb_strtoupper($product->translate(locale())->name, 'UTF-8') }}</b></h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th class="table-title">{{ trans('tradevillage::products.description') }}</th>
                            <td>{{ $product->translate(locale())->description }}</td>
                        </tr>
                        <tr>
                            <th class="table-title">{{ trans('tradevillage::products.material') }}</th>
                            <td>{{ $product->translate(locale())->material }}</td>
                        </tr>
                        <tr>
                            <th class="table-title">{{ trans('tradevillage::products.category') }}</th>
                            <td>{{ $product->category->translate(locale())->name }}</td>
                        </tr>
                        <tr>
                            <th class="table-title">{{ trans('tradevillage::products.cost') }}</th>
                            <td>{{ $product->cost }} {{ trans('tradevillage::products.unit') }}</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <div class="product-footer-box">
                        <div class="col-md-3 col-xs-4">
                            @include('tradevillage::frontend.villages.products.partials.rate', ['product' => $product])
                        </div>
                        <div class="col-md-6 col-xs-8">
                            <p class="blue-text"><b>{{ trans('tradevillage::products.contact') }}</b></p>
                            @if($product->enterprise)
                                <img src="{{ Imagy::getThumbnail($product->enterprise->feature_image['path'].'', 'smallThumb') }}"/>

                                <a href="{{ route('frontend.tradevillage.enterprises.show', [$product->enterprise->id]) }}">{{ $product->enterprise->translate(locale())->name}}</a>
                                <p>{{ $product->enterprise->contact }}</p>
                                <p>Website: <a href="{{ $product->enterprise->website }}">{{ $product->enterprise->website }}</a></p>
                                <p>{{ trans('tradevillage::products.address') }}: {{ $product->enterprise->translate(locale())->address}}</p>
                            @elseif($product->artist)
                                <img src="{{ Imagy::getThumbnail($product->artist->feature_image['path'].'', 'smallThumb') }}" style="border-radius: 50%; max-height: 50px" />
                                <a href="{{ route('frontend.tradevillage.artist.show', [$product->artist->id]) }}">{{ $product->artist->translate(locale())->name}}</a>
                                <p>{{ trans('tradevillage::products.address') }}: {{ $product->artist->translate(locale())->address}}</p>
                                {{ $product->artist->contact }}
                            @endif
                        </div>
                        @if($product->model)
                            <div class="col-md-3 col-xs-12">
                                <a href="{{ route('frontend.tradevillage.products.model', [$product->id]) }}" class="btn btn-primary" target="_blank">{{ trans('tradevillage::products.show_model') }}</a>
                            </div>
                        @endif
                        @if(count($product->processes) > 0 )
                            <div class="col-md-3 col-xs-12">
                                <a href="{{ route('frontend.tradevillage.products.processes', $product->id) }}" class="btn btn-success show_processes" target="_blank">{{ trans('tradevillage::products.show_processes') }}</a>
                            </div>
                        @else
                            @can('update-product', $product)
                                <div class="col-md-3 col-xs-12">
                                    <a href="{{ route('frontend.tradevillage.products.processes', $product->id) }}" class="btn btn-success show_processes" target="_blank">{{ trans('tradevillage::products.show_processes') }}</a>
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#comments"><b>{{ trans('tradevillage::products.comments') }}</b></a></li>
            <li><a data-toggle="tab" href="#detail"><b>{{ trans('tradevillage::products.detail') }}</b></a></li>
        </ul>
        <div class="tab-content">
            <div id="comments" class="tab-pane fade in active">
                @include('tradevillage::frontend.villages.products.partials.comments', ['product' => $product])
                <div class="center-div">{{ $comments->links() }}</div>
            </div>

            <div id="detail" class="tab-pane fade">
                {!! $product->translate(locale())->detail !!}
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="refe-products">
            <h4><b>{{ trans('tradevillage::products.similar') }}</b></h4>
            @foreach ($categories as $category)
                @if($category->id == $product->category_id)
                    <div class="row">
                        <div class="categories-item col-md-9">
                            <div id="products" class="row">
                                <div class="list-group">
                                    @include('tradevillage::frontend.villages.products.partials.product', ['category' => $category, 'current_product' => $product])
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        
    </div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-rating-input.min.js') }}"></script> 
<script type="text/javascript">
    $('.carousel').carousel({
        interval: false
    });
    $('.nav-products').addClass("active-nav");
    function round(value, decimals) {
        return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
    }
    $( document ).ready(function() {
        $("#rating-product").change(function(e){
            e.preventDefault();
            var rate_value = $('#rating-product').val();
            var CSRF_TOKEN = $('input[name="_token"]').val();
            $.ajax({
                type:"POST",
                url: {{ $product->id }}+"/rate",
                data: {
                    _token: CSRF_TOKEN,
                    value: rate_value},
                success: function(data) {
                    $('.alert').removeClass('flash-hidden');
                    $('.alert').fadeOut(3000);
                    $('#rate_avg').html(data.rate_avg);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $('.cmt-box-control').hide();
    var $win = $(window);
    var $box = $('.cmt-box');
    $win.on('click.Bst', function(event){       
        if ($box.has(event.target).length == 0 && !$box.is(event.target)){
            var cmtContent = document.getElementById('cmtContent').value;
            if(cmtContent == "") {
                $('.cmt-box-control').hide();
            }
            if(cmtContent != "") {
                $('.cmt-cancel').click(function(){
                    document.getElementById('cmtContent').value = "";
                });
            }
        } else {
            $('.cmt-box-control').show();
        }
    });

    $('.cmt-submit').click(function(){
        var content = $('#cmtContent').val();
        var CSRF_TOKEN = $('input[name="_token"]').val();

        $.ajax({
            url     : {{ $product->id }} + '/comment',
            method  : 'post',
            data    : {_token: CSRF_TOKEN, content: content},
            success : function(response){
                location.reload();
            }
        });
    });
    $('.edit-cmt-control').hide();
    $('.to-hover').hover(function(){
        $('.edit-cmt-control').show();
        }, function(){
        $('.edit-cmt-control').hide();
    }); 

</script>

<script type="text/javascript">
    $('.delete-modal').click(function() {
        var id = $(this).data("id");
        var url_delete = '/tradevillage/products/comment';
        $('#delete').click(function() {
            $.ajax({
                type: 'delete',
                dataType: 'json',
                url: url_delete,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function() {
                    location.reload();
                }
                    });
        });
    });

    $("#rating-product").change(function(e){
        e.preventDefault();
        var rate_value = $('#rating-product').val();
        var CSRF_TOKEN = $('input[name="_token"]').val();
        $.ajax({
            type:"POST",
            url: {{ $product->id }}+"/rate",
            data: {
            	_token: CSRF_TOKEN,
            	value: rate_value},
            success: function(data) {
    			$('.alert').fadeToggle(1000);
    			$('.alert').fadeOut(3000);
    			$('.rates-number').html(data.rates_number);
    			$('#rate_avg').html(data.rate_avg);
            }
    	});
	});
</script>
@stop