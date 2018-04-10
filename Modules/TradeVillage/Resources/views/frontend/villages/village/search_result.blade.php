@extends('layouts.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tradeVillageIndex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/filter.css') }}">
@stop

@section('content')
    <div class="row main-content">
        <div class="col-md-3 col-xs-12 pull-right search-box">
            <div class="row">
                {!! Form::open(['route' => ['frontend.tradevillage.search.village'], 'method' => 'get']) !!}
                <div class="col-md-12">
                    <div class="input-group add-on">
                        <input class="form-control" placeholder= "{{ trans('tradevillage::main.filter.search') }}" name="search" id="search" value="{{isset($key)? $key: ''}}" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row filter">
            <div class="filter-group">
                <table class="table-responsive">
                    <tr>
                        <td><p class="filter-item">Tỉnh/ thành phố</p></td>
                        <td>
                            <select class="form-control filter-item" name="province">
                                <option value="all" {{ $province=='all'? 'selected' : '' }}>{{ trans('tradevillage::main.title.all') }}</option>
                                <option value="Hà nội" {{ $province=='Hà nội'? 'selected' : '' }}>Hà Nội</option>
                                <option value="Hải phòng" {{ $province=='Hải phòng'? 'selected' : '' }}>Hải Phòng</option>
                                <option value="Nam định" {{ $province=='Nam định'? 'selected' : '' }}>Nam Định</option>
                                <option value="Hưng yên" {{ $province=='Hưng yên'? 'selected' : '' }}>Hưng Yên</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="filter-group">
                <table>
                    <tr>
                        <td><p class="filter-item">{{ trans('tradevillage::main.filter.category') }}</p></td>
                        <td>
                            <select class="form-control filter-item" id="category_select" name="category">
                                <option value=0 {{ isset($category)? '' : 'selected' }}>
                                    {{ trans('tradevillage::main.title.all') }}
                                </option>
                                @if(isset($category))
                                    @foreach($categories as $cate)
                                        <option value={{ $cate->id }} {{ $cate->id==$category? 'selected' : '' }} >
                                            {{ $cate->translate(locale())->name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach($categories as $cate)
                                        <option value={{ $cate->id }} >
                                            {{ $cate->translate(locale())->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            {!! Form::close() !!}
        </div>
        <h4><b>{{ trans('tradevillage::main.filter.search') }}</b> > <a href="{{ route('frontend.tradevillage.villages.index') }}"><b>{{ trans('tradevillage::main.filter.village') }}</b></a> > "{{ $key }}"</h4>
        <hr>
        <div class="row">
            @if(count($villages) > 0)
                @foreach($villages as $village)
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
                {{ $villages->links() }}
            @else
                {{ trans('tradevillage::main.title.no_village') }}
            @endif
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZMQRL3iYa5SHiluzgTJrHA_otrA52ec&libraries=drawing"></script>
    <script type="text/javascript">
        $('.nav-villages').addClass("active-nav");
    </script>
@stop
