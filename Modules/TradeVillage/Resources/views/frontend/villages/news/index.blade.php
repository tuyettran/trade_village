@extends('layouts.master')

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tinTucSuKien.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="col-md-3 col-sm-3" style="float: right;">
                <form class="navbar-form" role="search">
                    <div class="input-group add-on">
                        <input class="form-control" name="srch-term" id="srch-term" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- news slideshow -->
        <div class="col-md-12 box">
            <a href="#"><h3 class="news">{{ trans('tradevillage::news.other.newest') }}</h3></a>
            <div id="myCarousel" class="carousel fdi-Carousel slide">
            <!-- Carousel items -->
                <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                    <div class="carousel-inner onebyone-carosel">
                        <?php $i = 0 ?>
                        @foreach($newests as $newest)
                            <div class="item {{ $i==0 ? 'active' : ''}}">
                                <div class="col-md-3">
                                    <a href="{{ route('frontend.tradevillage.news.show', [$newest->id]) }}"><img class="thumbnail img-responsive center-block" src="@thumbnail($newest->feature_image->path, 'mediumThumb')"></a>
                                    <a href="{{ route('frontend.tradevillage.news.show', [$newest->id]) }}"><h5>{{ $newest->translate(locale())->title }}</h5></a>
                                </div>
                            </div>
                        <?php $i++ ?>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#eventCarousel" data-slide="prev"></a>
                    <a class="right carousel-control" href="#eventCarousel" data-slide="next"></a>
                </div>
                <!--/carousel-inner-->
            </div><!--/myCarousel-->
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>       
        </div> <!-- end news slideshow -->

        <div class="col-md-12">
            <a href="#"><h3 class="news">{{ trans('tradevillage::news.other.news') }}</h3></a>
            <div class="col-md-9">
                <?php $j = 1 ?>
                @foreach($news as $new)
                    <div class="new">
                        <a href="{{ route('frontend.tradevillage.news.show', [$new->id]) }}" class="col-md-12">{{ $new->translate(locale())->title }}</a>
                        <div class="new-info">
                            <div class="col-md-3 new-img"><a href="{{ route('frontend.tradevillage.news.show', [$new->id]) }}"><img src="@thumbnail($new->feature_image->path, 'mediumThumb')" class="thumbnail"/></a></div>
                            <div class="col-md-9 img-info">
                                <p class="time">{{ $new->updated_at }}</p>
                                <div class="info-detail">{!! $new->translate(locale())->content !!}</div>
                            </div>
                        </div>
                    </div>
                    @if($j%10 != 0 && $j != count($news))
                        <hr class="col-md-12">
                    @endif
                <?php $j++ ?>
                @endforeach
            </div>
        </div>
        <div class="paginate"> {{ $news->links() }} </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/newsSlideshow.js') }}"></script>
@stop