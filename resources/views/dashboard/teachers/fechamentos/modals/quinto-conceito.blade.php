<!-- Modal -->
<div class="modal fade" id="modalQuintoConceito" data-bs-backdrop="static" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="mb-2 text-warning">Turma: {{$discipline->room->name}} / Disciplina: {{$discipline->name}} / Quinto Conceito</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center text-uppercase"
                                    style="background-color: #e57373 !important;color: #ffffff !important;">Total de aulas dadas no ano
                                </th>
                            </tr>
                            <tr>
                                @if($discipline->room->status_q_c !== 1)
                                    <th scope="col">
                                        <input type="text" value="{{$discipline->t_a_d_ano}}"
                                               class="form-control form-control-sm text-center text-uppercase" readonly>
                                    </th>
                                @endif
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <form action="{{route('dashboard.students.dados.quintoConceito',$discipline->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <input type="hidden" name="tipo_ensino_id" value="{{$discipline->tipoEnsino->id}}">
                            <input type="hidden" name="serie_id" value="{{$discipline->serie->id}}">
                            <input type="hidden" name="room_id" value="{{$discipline->room->id}}">
                            <input type="hidden" name="discipline_id" value="{{$discipline->id}}">
                            <div class="row">
                                <table class="table table-sm table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center text-uppercase"
                                            style="background-color: #2c3e50 !important;color: #ffffff !important;">Selecionar arquivo
                                        </th>
                                        <th scope="col" class="text-center text-uppercase"
                                            style="background-color: #2c3e50 !important;color: #ffffff !important;">inportar
                                        </th>
                                    </tr>
                                    <tr>
                                        @if($discipline->room->status_q_c !== 1)
                                            <th scope="col">
                                                <input type="file" name="select_file" id="field" class="form-control form-control-sm">
                                                @error('select_file') <span class="text-danger">{{$message}}</span>@enderror
                                            </th>
                                            <th scope="col" class="text-center">
                                                <input type="submit" id="submit" name="upload" class="btn btn-sm btn-success btn-submit"
                                                       value="Importar">
                                            </th>
                                        @endif
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                <form action="{{route('dashboard.fechamentos.updateFechamentoStudentsQuintoConceito',$discipline->id)}}"
                      method="post">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="table-wrapper">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="sticky">
                                {{--                        TOP TABLE FECHAMENTO--}}
                                <tr>
                                    <th scope="col" colspan="2" class="text-center text-uppercase">Estudantes</th>

                                    <th scope="col" colspan="1" class="text-center text-uppercase"
                                        style="background-color: #e57373 !important;color: #ffffff !important;">5ºC
                                    </th>
                                    <th scope="col" colspan="3" class="text-center text-uppercase"
                                        style="background-color: #607d8b !important;color: #ffffff !important;">Informação
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" style="width: 1rem" class="text-center text-uppercase">Nº</th>
                                    <th scope="col" class="text-center text-uppercase">Nome</th>

                                    {{--PRIMEIRO BIMESTRE--}}
                                    <th scope="col" class="text-center text-uppercase"
                                        style="background-color: #e57373 !important;color: #ffffff !important;">N
                                    </th>
                                    <th scope="col" class="text-center text-uppercase"
                                        style="background-color: #e57373 !important;color: #ffffff !important;">Situação do aluno
                                    </th>
                                </tr>
                                {{--                        TOP TABLE FECHAMENTO--}}
                                </thead>
                                @foreach($fechamentos as $fechamento)
                                    <tbody class="body_students">
                                    <tr>
                                        <td class="text-center text-truncate">{{$fechamento->student->number}}</td>
                                        <input class="student_number" type="hidden" name="student_number[]"
                                               value="{{$fechamento->student->number}}">
                                        <td class="text-truncate student_name">{{$fechamento->student->name}}</td>
                                        <input type="hidden" name="id[]" value="{{$fechamento->id}}">
                                        <input type="hidden" name="discipline_id[]" value="{{$discipline->id}}">
                                        <input type="hidden" name="student_id[]"
                                               value="{{$fechamento->student->id}}">
                                        {{--NOTAS 1º BIMESTRE--}}
                                        <td class="text-center">
                                            @if($discipline->room->status_q_c !== 1)
                                                @switch($fechamento->n_q_c)
                                                    @case(ctype_alpha($fechamento->n_q_c) == true)
                                                        <input type="text" style="width: 2.5rem"
                                                               name="n_q_c[]"
                                                               class="table-target nota_aluno text-secondary text-uppercase"
                                                               tabindex="1"
                                                               value="{{$fechamento->n_q_c,old('n_q_c')}}" required>
                                                        @break
                                                    @case($fechamento->n_q_c >= 5)
                                                        <input type="text" style="width: 2.5rem" name="n_q_c[]"
                                                               class="table-target nota_aluno text-primary"
                                                               tabindex="1"
                                                               value="{{$fechamento->n_q_c,old('n_q_c')}}" required>
                                                        @break

                                                    @case($fechamento->n_q_c < 5)
                                                        <input type="text" style="width: 2.5rem" name="n_q_c[]"
                                                               class="table-target nota_aluno text-danger"
                                                               tabindex="1+"
                                                               value="{{$fechamento->n_q_c,old('n_q_c')}}" required>
                                                        @break
                                                @endswitch
                                            @else
                                                @switch($fechamento->n_s_b)
                                                    @case(ctype_alpha($fechamento->n_q_c) == true)
                                                        <input type="text" style="width: 2.5rem"
                                                               name="n_q_c[]"
                                                               class="table-target text-secondary text-uppercase"
                                                               tabindex="1"
                                                               value="{{$fechamento->n_q_c,old('n_q_c')}}" readonly>
                                                        @break
                                                    @case($fechamento->n_q_c >= 5)
                                                        <input type="text" style="width: 2.5rem" name="n_q_c[]"
                                                               class="table-target text-primary"
                                                               tabindex="1"
                                                               value="{{$fechamento->n_q_c,old('n_q_c')}}"
                                                               readonly>
                                                        @break

                                                    @case($fechamento->n_q_c < 5)
                                                        <input type="text" style="width: 2.5rem" name="n_q_c[]"
                                                               class="table-target text-danger"
                                                               tabindex="1"
                                                               value="{{$fechamento->n_q_c,old('n_q_c')}}"
                                                               readonly>
                                                        @break
                                                @endswitch
                                            @endif
                                        </td>
                                        <td>
                                            {{$fechamento->student->student_situation}}
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
                        <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-dismiss="modal">Fechar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
