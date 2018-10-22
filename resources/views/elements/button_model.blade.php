{!! 
    Html::decode(Html::link('#', '<i class="fa fa-fw ' . $iconButton . '"></i>' . __( $nameModal ), ['class' => 'btn btn-' . $colorButton . '', 'data-toggle' => 'modal', 'data-target' => '#modal-' . $nameModal . '' . $record->id]))
!!}
<div class="modal" id="modal-{{ $nameModal }}{{ $record->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 15px;">
                <p>Bạn có muốn xóa bản ghi？</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' =>'delete', 'url' => (route($nameRoute, $record))]) }}
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        {{ Form::submit('Ok', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
