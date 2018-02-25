@extends('layouts.master')

@section('content')
    <div class="row custom-container">
        {!! Form::open(['route' => ['frontend.tradevillage.products.store'], 'method' => 'post', 'files' => true]) !!}
            <div class="box-body">
                @include('tradevillage::frontend.villages.products.partials.edit-field')
            </div>
            <div class="box-footer pull-right">
                <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                <a class="btn btn-danger btn-flat" href="{{ route('frontend.tradevillage.products.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
            </div>
        {!! Form::close() !!}
    </div>
    
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(".delete-model-btn").click(function(){
                $("#file-1").prop("disabled", false);
                $(".files-list").hide();
                $("#delete_model").val("yes");
            });
            $("#images").change(function(){
                $('#image_preview').html("");
                var total_file=document.getElementById("images").files.length;
                for(var i=0;i<total_file;i++)
                {
                    $('#image_preview').append("<div class=' col-md-2 col-xs-4'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive thumbnail medium-thumbnail' ></div>");
                }
            });
            $('.super-header').hide();
        });
    </script>
@stop