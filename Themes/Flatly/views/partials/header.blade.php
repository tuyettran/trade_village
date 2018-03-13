<div class="super-header">
	<img src="{{ URL::asset('/images/ntbic-header.png') }}" class="img-responsive">
	@if($currentUser)
		<div class="user sign bottom-right">
			<div class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle white-text" data-toggle="dropdown">
                    <i class="fa fa-flag"></i>
                    <span>
                        <span class="glyphicon glyphicon-user"> </span><b>{{ $currentUser->first_name.' '.$currentUser->last_name }}</b><i class="caret"></i>
                    </span>
                </a>
                <ul class="dropdown-menu user-menu">
                	<li><a href="">My Profile</a></li>
                	<li><a href="">My products</a></li>
               		<li><a href="">My courses</a></li>
                </ul>
            </div>
        </div>
		<!-- <div class="user sign bottom-right">
			<a href=""><span class="glyphicon glyphicon-user"></span><b>{{ $currentUser->first_name.' '.$currentUser->last_name }}</b></a>
		</div> -->
	@else
		<div class="sign bottom-right">
			<a href="{{ route('login') }}" class="btn btn-warning black-text">Đăng nhập</a>
			<a href="{{ route('register') }}" class="btn btn-warning black-text">Đăng ký</a>
		</div>
	@endif
</div>