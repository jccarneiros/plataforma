<!-- Modal -->
<div class="modal fade" id="disciplineInformations{{$fechamento->discipline->id}}" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(52, 73, 94) !important;color: #cccccc !important;">
            <div class="modal-header">
                <h6>{{$fechamento->student->name}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="font-size: 100% !important;">
                    <span class="pb-3">Série: {{$fechamento->discipline->serie->name}}</span>
                    <hr>
                    <hr>
                    <span class="pb-3">Turma: {{$fechamento->room->name}}</span>
                    <hr>
                    <hr>
                    <span class="pb-3">Disciplina: {{$fechamento->discipline->name}}</span>
                    <hr>
                    <hr>
                    @if(isset($fechamento->discipline->user->name))
                        <span class="pb-3">Professor:  {{$fechamento->discipline->user->name}}</span>
                    @endif

                    <hr>
                    <hr>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <span class="pb-3">Data de criação:  {{\Carbon\Carbon::parse($fechamento->created_at)->format('d/m/Y H:i')}}</span>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <span class="pb-3">Última atualização: {{\Carbon\Carbon::parse($fechamento->updated_at)->format('d/m/Y H:i')}}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
