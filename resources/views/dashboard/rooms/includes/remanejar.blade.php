@can('students.edit')
    <div class="modal fade" id="{{ 'modal_Remanejar_Student' . $student->id  }}" tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Remanejar: {{$student->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('dashboard.students.ramanejamento', $student->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <small style="background-color: rgb(52, 73, 94) !important;" class="mb-3">
                                <p class="mt-3"> Para remanejar o aluno(a), selecione as opções e clique em salvar.</p>
                                <p class="mt-3" style="font-size: 120% !important;">Status Atual do aluno(a): Tipo de
                                    Ensino: {{$student->tipoEnsino->name}} /
                                    Série: {{$student->serie->name}} /
                                    Turma: {{$student->room->name}} /
                                    Nº: {{$student->number}}</p>
                            </small>
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                                <label for="tipo_ensino_id" class="label-custom">Tipo de Ensino</label>
                                <select name="tipo_ensino_id" id="tipo_ensino_id" class="form-select form-control-sm">
                                    <option value="{{$student->tipoEnsino->id}}"
                                            selected>{{$student->tipoEnsino->name}}</option>
                                    @foreach($tipoEnsinos as $tipoEnsino)
                                        <option value="{{$tipoEnsino->id}}">{{$tipoEnsino->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
                                <label for="serie_id" class="label-custom">Série</label>
                                <select name="serie_id" id="serie_id" class="form-select form-control-sm">
                                    <option value="{{$student->serie->id}}" selected>{{$student->serie->name}}</option>
                                    @foreach($series as $serie)
                                        <option value="{{$serie->id}}">{{$serie->tipoEnsino->name}}
                                            | {{$serie->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 mb-3">
                                <label for="room_id" class="label-custom">Turma</label>
                                <select name="room_id" id="room_id" class="form-select form-control-sm">
                                    <option value="{{$student->room->id}}" selected>{{$student->room->name}}</option>
                                    @foreach($rooms as $room)
                                        <option value="{{$room->id}}">{{$room->tipoEnsino->name}}
                                            | {{$room->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                <label for="number" class="label-custom">Nº</label>
                                <select name="number" id="number" class="form-select form-select-sm">
                                    <option value="{{$student->number}}" selected>{{$student->number}}</option>
                                    @foreach(range(1,100) as $student)
                                        <option value="{{$student}}">{{$student}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                <button type="submit" class="btn btn-sm btn-warning w-100">Salvar</button>
                                <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-dismiss="modal">
                                    Fechar
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan