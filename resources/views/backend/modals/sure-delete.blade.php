<div class="modal inmodal fade" id="{{$modelToDelete}}" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">{{$question}}</h4>
                <h5 id="resultado"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-danger" data-action="delete">Borrar</button>
            </div>
        </div>
    </div>
</div>
