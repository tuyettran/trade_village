@extends('layouts.master')

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tinTucSuKienDetail.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-md-9 new-event-detail">
            <h2>{{ $new->translate(locale())->title }}</h2>
            <div class="new-event-img">
                <a href="#"><img class="thumbnail" src="@thumbnail($new->feature_image->path, 'largeThumb')"></a>
            </div>
            <div class="rest-content">
                {!! $new->translate(locale())->content !!}
            </div>
        </div>

        <div class="col-md-3 col-sm-3" style="float: right;">
            {!! Form::open(['route' => ['frontend.tradevillage.search.new'], 'method' => 'get']) !!}
                <div class="input-group add-on">
                    <input class="form-control" name="search" id="search" type="text">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    
        <div class="col-md-3 col-sm-12 col-xs-12 box">

            <div class="col-sm-6 col-md-12 col-xs-12">
                <a href="#"><h4 class="new-bar">{{ trans('tradevillage::news.other.relatedNews') }}</h4></a>
                @foreach($relatedNews as $relatedNew)
                    @if($relatedNew->id != $new->id)
                            <div class="new-info">
                                <div class="col-md-3 col-sm-3 col-xs-3 new-img"><a href="#"><img class="thumbnail" src="@thumbnail($relatedNew->feature_image->path, 'smallThumb')"></a></div>
                                <div class="col-md-9 img-info">
                                    <p class="time">{{ $relatedNew->updated_at }}</p>
                                    <p class="info-detail">{{ $relatedNew->translate(locale())->title }}</p>
                                </div>
                            </div>
                            <div class="col-md-12 tab-bot"></div>
                        @endif
                @endforeach
            </div>

            <div class="col-sm-6 col-md-12 col-xs-12">
                <a href="#"><h4 class="new-bar">{{ trans('tradevillage::news.other.newest') }}</h4></a>
                <?php $i = 0; ?>
                @foreach($newests as $newest)
                    @if($newest->id != $new->id)
                        <div class="new-info">
                            <div class="col-md-3 col-sm-3 col-xs-3 new-img"><a href="#"><img class="thumbnail" src="@thumbnail($newest->feature_image->path, 'smallThumb')"></a></div>
                            <div class="col-md-9 img-info">
                                <p class="time">{{ $newest->updated_at }}</p>
                                <div class="info-detail">{{ $newest->translate(locale())->title }}</div>
                            </div>
                        </div>
                        <div class="col-md-12 tab-bot"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $('.nav-news').addClass("active-nav");
    </script>
@stop