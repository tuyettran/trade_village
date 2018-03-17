@extends('layouts.master')

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tradeVillageIndex.css') }}">
@stop

@section('content')
    <div class="col-md-3 col-sm-3" style="float: right;">
        <form class="navbar-form" role="search">
            <div class="input-group add-on">
                <input class="form-control" placeholder="Tìm kiếm sản phẩm" name="srch-term" id="srch-term" type="text">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    
    <ul class="nav nav-tabs village-category">
        <?php $i = 0 ?>
        @if(isset($categories))
            @foreach($categories as $category)
                @if(count($categories[$i]->villages) > 0)
                    <li class="{{ $i==0 ? 'active' : ''}}"><a data-toggle="tab" href="#{{ $categories[$i]->id }}" class="orange-text">{{ $category->translate(locale())->name }}</a></li>
                    <?php $i++ ?>
                @endif
            @endforeach
        @endif
    </ul>
    <div class="tab-content">
        @if(count($categories[0]->villages) > 0)
            <div id="{{ $categories[0]->id }}" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-md-6 col-xs-12 introduce">
                        {{ $categories[0]->translate(locale())->description }}
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row filter">
                            <div class="filter-group">
                                <button class="filter-item">Tên<span class="glyphicon glyphicon glyphicon-sort"></span></button>
                                <button class="filter-item">Yêu thích<span class="glyphicon glyphicon glyphicon-sort"></span></button>
                            </div>
                            <div class="filter-group">
                                <table class="table-responsive">
                                    <tr>
                                        <td><p class="filter-item">Tỉnh/ thành phố</p></td>
                                        <td>
                                            <select class="form-control filter-item">
                                                <option>Hà Nội</option>
                                                <option>Hải Phòng</option>
                                                <option>Nam Định</option>
                                                <option>Hưng Yên</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row village-list">
                    @foreach($categories[0]->villages as $village)
                        <div class="col-md-6 village">
                            <div class="row">
                                <div class="col-md-4 col-xs-12"><img src="@thumbnail($village->image_village->path, 'mediumThumb')" class="thumbnail village-spec"/></div>
                                <div class="col-md-8 col-xs-12">
                                    <h4><a href="{{ route('frontend.tradevillage.villages.show', [$village->id]) }}">{{ $village->translate(locale())->name }}</a></h4>
                                    <p class="twoline">{{ $village->translate(locale())->description }}</p>
                                    <p class="address">
                                        {{ trans('tradevillage::villages.table.address') }} : {{ $village->district }} - {{ $village->province }}
                                    </p>
                                    <p class="visits">{{ $village->visitor_counter }} {{ trans('tradevillage::villages.table.nov') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @for($i = 1; $i < count($categories); $i++)
            @if(count($categories[$i]->villages) > 0)
                <div id="{{ $categories[$i]->id }}" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-6 col-xs-12 introduce">
                            {{ $categories[$i]->translate(locale())->description }}
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="row filter">
                                <div class="filter-group">
                                    <button class="filter-item">Tên<span class="glyphicon glyphicon glyphicon-sort"></span></button>
                                    <button class="filter-item">Yêu thích<span class="glyphicon glyphicon glyphicon-sort"></span></button>
                                </div>
                                <div class="filter-group">
                                    <table class="table-responsive">
                                        <tr>
                                            <td><p class="filter-item">Tỉnh/ thành phố</p></td>
                                            <td>
                                                <select class="form-control filter-item">
                                                    <option>Hà Nội</option>
                                                    <option>Hải Phòng</option>
                                                    <option>Nam Định</option>
                                                    <option>Hưng Yên</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row village-list">
                        @foreach($categories[$i]->villages as $village)
                            <div class="col-md-6 village">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12"><img src="@thumbnail($village->image_village->path, 'mediumThumb')" alt="" class="thumbnail village-spec"/></div>
                                    <div class="col-md-8 col-xs-12">
                                        <h4><a href="{{ route('frontend.tradevillage.villages.show', [$village->id]) }}">{{ $village->translate(locale())->name }}</a></h4>
                                        <p class="twoline">{{ $village->translate(locale())->description }}</p>
                                        <p class="address">
                                            {{ trans('tradevillage::villages.table.address') }} : {{ $village->district }} - {{ $village->province }}
                                        </p>
                                        <p class="visits">{{ $village->visitor_counter }} {{ trans('tradevillage::villages.table.nov') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endfor
    </div>
@stop
