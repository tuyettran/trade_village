<div class="super-header">
	<img src="{{ URL::asset('/images/ntbic-header.png') }}" class="img-responsive">
	@if($currentUser)
		<div class="user sign top-right">
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
        </div>
	@else
		<div class="sign top-right">
			<a href="{{ route('login') }}" class="btn btn-warning black-text">{{ trans('tradevillage::main.title.login') }}</a>
			<a href="{{ route('register') }}" class="btn btn-warning black-text">{{ trans('tradevillage::main.title.register_new') }}</a>
		</div>
	@endif
</div>