<div class="">
    <a href="" data-toggle="modal" data-target="#myModal">{{ __('Delete') }}</a>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Are you sure to delete this item?') }}</h4>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            {{ Form::open([ 'method' =>'delete', 'url' => route($nameRoute, $data->id) ]) }}
                            {{ Form::submit(__('Yes'), ['class' => 'btn btn-default']) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-6 text-left">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('No') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
