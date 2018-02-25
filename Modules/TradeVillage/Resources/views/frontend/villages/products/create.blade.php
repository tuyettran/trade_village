<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">translate</button>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

<!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">translate</h4>
            </div>
            {!! Form::open(['route' => ['admin.tradevillage.products.store'], 'method' => 'post', 'files' => true]) !!}
                <div class="modal-body">
                        @include('tradevillage::frontend.villages.products.partials.create-field')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>