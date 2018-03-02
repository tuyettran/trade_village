<div class="super-header">
	<img src="{{ URL::asset('/images/ntbic-header.png') }}" class="img-responsive">
	@if($currentUser)
		<div class="user sign bottom-right">
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag"></i>
                    <span>
                        <span class="glyphicon glyphicon-user"></span><b>{{ $currentUser->first_name.' '.$currentUser->last_name }}</b><i class="caret"></i>
                    </span>
                </a>
                <ul class="dropdown-menu language-menu">
                	<li>Profile</li>
                	<li>My products</li>
               		<li>My courses</li>
                </ul>
            </li>
        </div>
		<!-- <div class="user sign bottom-right">
			<a href=""><span class="glyphicon glyphicon-user"></span><b>{{ $currentUser->first_name.' '.$currentUser->last_name }}</b></a>
		</div> -->
	@else
		<div class="sign bottom-right">
			<a href="#" class="btn btn-warning black-text">Đăng nhập</a>
			<a href="#" class="btn btn-warning black-text">Đăng ký</a>
		</div>
	@endif
</div>