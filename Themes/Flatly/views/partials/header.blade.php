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
                        <li><a href="">My Profile</a></li>
	                	<li><a href="{{ route('frontend.tradevillage.products.user_products', $currentUser->id) }}">My products</a></li>
	               		<li><a href="">My courses</a></li>
                    </ul>
                </li>
            </ul>
        </div>
	@else
		<div class="sign top-right">
			<a href="{{ route('login') }}" class="btn btn-warning black-text">Đăng nhập</a>
			<a href="{{ route('register') }}" class="btn btn-warning black-text">Đăng ký</a>
		</div>
	@endif
</div>