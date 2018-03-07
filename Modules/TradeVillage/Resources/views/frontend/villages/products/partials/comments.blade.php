@if(count($comments)>0)
	@foreach($comments as $comment)
		<div>
			<div class="col-md-1">
				@if(isset($images))
				<img src="{{URL::asset('images/book2.png')}}" class="user-avatar pull-right" />
			@endif
			</div >
			<div class="col-md-11">
				<a href="#">{{ $comment->user->first_name.' '.$comment->user->last_name }}</a>
				<br/>
				<div>{!! $comment->content !!}</div>
				<p class="darkgrey-text">{{ $comment->created_at }}</p>
			</div>
		</div>
	@endforeach
@else
	<div class="darkgrey-text">
		{{trans('tradevillage::products.no comment')}}
	</div>
@endif

<div>
	@if(Auth::user())
		{!! Form::open(['route' => ['frontend.tradevillage.products.store'], 'method' => 'post', 'files' => true]) !!}
	    <div class="rate col-md-offset-1 col-md-11">
	    	<div class="form-group{{ $errors->has("category_id") ? " has-error" : "" }}">    
                {!! Form::textarea("content", old("content"), ["class" => "form-control", "placeholder" => trans("tradevillage::product_comments.table.content")]) !!}
                    
            </div>
		</div>
	@endif
</div>