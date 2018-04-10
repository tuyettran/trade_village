<div class="comment-side">
<div>
    @if(Auth::user())
        <div class="col-md-12 col-xs-12 col-md-12">
            <div class="col-md-1 col-xs-1 col-md-1">
                @if(isset($images))
                    <img src="{{URL::asset('images/default-avatar.png')}}" class="user-avatar pull-right" />
                @endif
            </div >
            {!! Form::open() !!}
            <div class="col-md-11 col-xs-11 col-md-11">
                <div class="cmt-box form-group{{ $errors->has("content") ? " has-error" : "" }}">
                    {!! Form::textarea("content", old("content"), ["id" => "cmtContent", "class" => "form-control", "placeholder" => trans("tradevillage::product_comments.table.content")]) !!}
                </div>
            </div>
            <div class="pull-right cmt-box-control">
                <button type="button" class="btn btn-danger cmt-cancel">{{ trans('tradevillage::product_comments.other.cancel') }}</button>
                <button type="button" class="btn btn-primary cmt-submit">{{ trans('tradevillage::product_comments.other.comment') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    @endif
</div>

@if(count($comments)>0)
    @foreach($comments as $comment) 
        <div class="col-md-12 col-xs-12 col-md-12">
            <div class="col-md-1 col-xs-1 col-md-1">
                @if(isset($images))
                    <img src="{{URL::asset('images/default-avatar.png')}}" class="user-avatar pull-right" />
                @endif
            </div >
            <div class="col-md-11 col-xs-11 col-md-11 to-hover">
                <a href="#">{{ $comment->user->first_name.' '.$comment->user->last_name }}</a>
                @if(Auth::user() && $currentUser->id == $comment->user->id)
                    <div class="pull-right edit-cmt-control">
                        <a class="delete-modal" data-toggle="modal" href="#small" data-id="{{$comment->id}}"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">{{ trans('tradevillage::product_comments.other.delCmt') }}</h4>
                                </div>
                                <div class="modal-body"> 
                                    <form>
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        {{ trans('tradevillage::product_comments.other.delCmtConfirm') }}
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="delete" class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @include('tradevillage::frontend.villages.delete_modal')
                @endif
                <br/>
                <div>{!! $comment->content !!}</div>
                <p class="darkgrey-text">{{ $comment->updated_at }}</p>
            </div>
        </div>  
    @endforeach
    
@else
    <div class="darkgrey-text">
        {{trans('tradevillage::products.no comment')}}
    </div>
@endif
</div>