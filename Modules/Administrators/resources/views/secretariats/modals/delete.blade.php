<form action="{{route('administrators.secretariats.delete', $secretariat->id)}}" method="POST">
    @csrf
    @method('DELETE')
    <div id="{{ 'modal_Delete' . $secretariat->id  }}" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 text-danger">ATENÇÃO!</h4>
                </div>
                <div class="modal-body text-center">
                    <p>Tem certeza de que deseja inativar este registro?</p>
                    <p>Este processo poderá ser desfeito na página dos registros inativos.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-sm">Bloquear</button>
                </div>
            </div>
        </div>
    </div>
</form>
