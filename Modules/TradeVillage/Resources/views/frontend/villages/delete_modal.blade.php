<div class="modal fade modal-danger" id="modal-delete-confirmation" tabindex="-1" role="dialog" aria-labelledby="delete-confirmation-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="delete-confirmation-title">{{ trans('core::core.modal.title') }}</h4>
            </div>
            <div class="modal-body">
                <div class="default-message">
                    <?php if (isset($message)): ?>
                        {!! $message !!}
                    <?php else: ?>
                        {{ trans('core::core.modal.confirmation-message') }}
                    <?php endif; ?>
                </div>
                <div class="custom-message"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-flat" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                {!! Form::open(['method' => 'delete', 'class' => 'pull-left']) !!}
                <button type="submit" class="btn btn-outline btn-flat"><i class="fa fa-trash"></i> {{ trans('core::core.button.delete') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
