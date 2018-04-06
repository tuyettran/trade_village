<div class="super-header">
	<img src="{{ URL::asset('/images/ntbic-header.png') }}" class="img-responsive">
    <div class="top-right">
        <div class="user sign">
            @if($currentUser)
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag"></i>
                        <span>
                            <span class="glyphicon glyphicon-user"></span><b>{{ $currentUser->first_name.' '.$currentUser->last_name }}</b>
                            <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu language-menu">
                        <li><a href="">{{ trans('tradevillage::main.title.my_profile') }}</a></li>
                        <li><a href="{{ route('frontend.tradevillage.products.user_products', $currentUser->id) }}">{{ trans('tradevillage::main.title.my_products') }}</a></li>
                        <li><a href="{{ route('logout') }}">{{ trans('tradevillage::main.title.logout') }}</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag"></i>
                        <span><b>
                            <img src="{{ asset('images/vi.PNG') }}" style="width: 20px; height: 20px">
                            {{ LaravelLocalization::getCurrentLocaleName()  }}
                            <i class="caret"></i></b>
                        </span>
                    </a>
                    <ul class="dropdown-menu language-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="{{ App::getLocale() == $localeCode ? 'active' : '' }}">
                                <a rel="alternate" lang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                    {!! $properties['native'] !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            @else
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag"></i>
                        <span><b>
                            <img src="{{ asset('images/vi.PNG') }}" style="width: 20px; height: 20px">
                            {{ LaravelLocalization::getCurrentLocaleName()  }}
                            <i class="caret"></i></b>
                        </span>
                    </a>
                    <ul class="dropdown-menu language-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="{{ App::getLocale() == $localeCode ? 'active' : '' }}">
                                <a rel="alternate" lang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                    {!! $properties['native'] !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-warning black-text">{{ trans('tradevillage::main.title.login') }}</a>
            <a href="{{ route('register') }}" class="btn btn-warning black-text">{{ trans('tradevillage::main.title.register_new') }}</a>
            @endif
        </div>
    </div>
</div>