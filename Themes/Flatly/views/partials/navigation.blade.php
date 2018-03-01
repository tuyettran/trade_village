<nav class="row navbar">
    <div class="header-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse " id="myNavbar">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="home.html">{{ trans('tradevillage::main.title.home') }}</a></li>
                <li><a href="home.html">{{ trans('tradevillage::main.title.event') }}</a></li>
                <li><a href="tinTucSuKien.html">{{ trans('tradevillage::main.title.new') }}</a></li>
                <li class="dropdown">
                    <a href="tradeVillageIndex.html">{{ trans('tradevillage::main.title.village') }}</a>
                </li>
                <li><a href="sanPhamCategory.html">{{ trans('tradevillage::main.title.product') }}</a></li>
                <li><a href="#">{{ trans('tradevillage::main.title.artist') }}</a></li>
                <li><a href="educateIndex.html">{{ trans('tradevillage::main.title.education') }}</a></li>
                <li><a href="#">{{ trans('tradevillage::main.title.contact') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag"></i>
                        <span>
                            {{ LaravelLocalization::getCurrentLocaleName()  }}
                            <i class="caret"></i>
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
        </div>
    </div>
</nav>