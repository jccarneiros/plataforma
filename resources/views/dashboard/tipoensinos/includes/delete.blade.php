@can('tipo_ensinos.delete')
    <div class="modal fade" id="{{ 'modal_Delete_TipoEnsino' . $item->id  }}" tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-confirm">
            <form action="{{route('dashboard.tipo_ensinos.delete', $item->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 text-danger">ATENÇÃO!</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p>Tem certeza de que deseja excluir este registro?</p>
                        <p>Este processo excluirá todos os registros relacionados.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endcan