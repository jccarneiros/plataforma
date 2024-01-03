@extends('layouts.master')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="with-line left">
                    {{$tipoEnsino->name}} / {{$room->serie->name}} / {{$room->name}} / Disciplinas
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{--FILTRO--}}
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <form action="{{route('dashboard.rooms.students.updateDisciplines', [$tipoEnsino->id, $serie->id,$room->id])}}"
                                  method="GET">
                                <select name="search" class="form-select form-control-sm" onchange="this.form.submit()">
                                    <option value="">Selecione um estudante na lista!</option>
                                    @foreach($room->students as $student)
                                        <option value="{{$student->number_ra}}">{{$student->name}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
                            @if(isset($search))
                                <a data-bs-toggle="modal" data-bs-target="#imageStudentRoom{{$item->id}}"
                                   style="cursor: pointer;color: #CCCCCC !important;">
                                    {{$item->name}}
                                </a>
                                @include('dashboard.rooms.modals.image-student-room', ['student' => $item])
                                <table class="table table-sm table-hover table-bordered" style="font-size: 85% !important;">
                                    <tbody>
                                    @if (isset($search))
                                        @foreach($adicionarNewStudentFechamento as $studentAdd)
                                            <tr>
                                                <td class="text-center">{{ $studentAdd->room->name }}</td>
                                                <td class="text-center">{{ $studentAdd->number }}</td>
                                                <td class="text-center">{{ $studentAdd->number_ra }}</td>
                                                <td class="text-center">{{ $studentAdd->number_ra_digit }}</td>
                                                <td class="text-truncate">{{ $studentAdd->name }}</td>
                                                <td class="text-truncate">{{ $studentAdd->email_google }}</td>
                                                <td class="text-truncate">{{ $studentAdd->student_situation }}</td>
                                                <td>
                                                    <form action="{{route('dashboard.rooms.students.createTableFechamentoStudentNew', [$tipoEnsino->id, $serie->id,$room->id])}}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="tipo_ensino_id" value="{{$room->tipoEnsino->id}}">
                                                        <input type="hidden" name="serie_id" value="{{$room->serie->id}}">
                                                        <input type="hidden" name="room_id" value="{{$room->id}}">
                                                        <input type="hidden" name="student_id" value="{{$studentAdd->id}}">
                                                        <input type="hidden" name="number_ra" value="{{$studentAdd->number_ra}}">
                                                        <input type="hidden" name="student_number" value="{{$studentAdd->number}}">
                                                        <input type="hidden" name="student_name" value="{{$studentAdd->name}}">
                                                        <input type="hidden" name="student_situation" value="{{$studentAdd->student_situation}}">
                                                        {{--                                        <input type="hidden" name="a_d_p_b" value="1">--}}
                                                        @foreach($room->disciplines as $discipline)
                                                            @if ($discipline->user_id != null)
                                                                <input type="hidden" name="user_id[]" value="{{$discipline->user->id}}">
                                                            @endif
                                                            <input type="hidden" name="tipo_ensino_id[]" value="{{$room->tipoEnsino->id}}">
                                                            <input type="hidden" name="serie_id[]" value="{{$room->serie->id}}">
                                                            <input type="hidden" name="room_id[]" value="{{$room->id}}">
                                                            <input type="hidden" name="discipline_id[]" value="{{$discipline->id}}">
                                                        @endforeach

                                                        <button type="submit" class="btn btn-sm btn-warning w-100">Inserir</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <small class="text-danger">Para inserir um novo aluno, selcione-o na lista ao lado, em
                                            seguida, clique em Inserir.</small>

                                    @endif

                                    </tbody>
                                </table>
                            @else
                                <small>Selecione um estudante na lista para fazer o remanejamento no conselho!</small>
                                <br>
                                <small>Para inserir um novo aluno, selcione-o na lista ao lado, em
                                    seguida, clique em Inserir.</small>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            @if(isset($search))
                                <a href="{{route('dashboard.disciplines.index', [$tipoEnsino->id, $serie->id,$room->id])}}"
                                   class="btn btn-sm btn-secondary">
                                    Limpar filtro
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($search))
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="2" class="text-center" style="background-color: #e57373 !important;color: #ffffff !important;">
                                            {{$room->name}}/ Disciplinas
                                        </th>
                                        <th class="text-center" style="background-color: #ba68c8 !important;color: #ffffff !important;">
                                            Estudante: {{$item->name}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fechamentos as $fechamento)
                                        <tr>
                                            <td class="text-center"
                                                style="width: 2rem"> {{$fechamento->discipline->id}}</td>
                                            <td>{{$fechamento->discipline->name}}</td>
                                            <td class="text-truncate text-center">
                                                @include('dashboard.rooms.includes.edit-student-fechamento', ['fechamento' => $fechamento])
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    {{--FILTRO--}}
                    @if(isset($search))

                    @else
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
                                <form method="POST" action="{{ route('dashboard.disciplines.store') }}">
                                    @csrf
                                    <input type="hidden" name="tipo_ensino_id" value="{{$room->tipoEnsino->id}}">
                                    <input type="hidden" name="serie_id" value="{{$room->serie->id}}">
                                    <input type="hidden" name="room_id" value="{{$room->id}}">
                                    @include('dashboard.rooms.includes.create-discipline',['room' => $room])
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                <form action="{{route('dashboard.disciplines.import')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="tipo_ensino_id" value="{{$room->tipoEnsino->id}}"
                                           class="form-control form-control-sm">
                                    <input type="hidden" name="serie_id" value="{{$room->serie->id}}" class="form-control form-control-sm">
                                    <input type="hidden" name="room_id" value="{{$room->id}}" class="form-control form-control-sm">
                                    @include('dashboard.rooms.includes.import-disciplines',['room' => $room])
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Disciplina</th>
                                            <th>Professor(a)</th>
                                            <th style="width: 12rem">Adicionar Professor(a)</th>
                                            {{--                                        <th style="width: 5rem">Alunos(a)</th>--}}
                                            <th style="width: 8rem">Criar Tabelas</th>
                                            <th style="width: 3rem">Editar</th>
                                            <th style="width: 3rem">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($room->disciplines->sortBy('name') as $discipline)
                                            <tr>
                                                <td class="text-truncate">{{$discipline->id}}</td>
                                                <td class="text-truncate">{{$discipline->name}}</td>
                                                <td class="text-truncate">
                                                    @if(empty($discipline->user->name))
                                                    @else
                                                        {{$discipline->user->name}}
                                                    @endif
                                                </td>
                                                <td class="text-truncate text-center">
                                                    @include('dashboard.rooms.includes.edit-teacher', ['discipline' => $discipline])
                                                </td>
                                                <td class="text-truncate text-center">
                                                    @include('dashboard.rooms.includes.create-table-fechamento')
                                                </td>
                                                <td class="text-truncate text-center">
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#{{ 'modal_Edit_Discipline' . $discipline->id }}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#{{ 'modal_Delete_Discipline' . $discipline->id }}"
                                                       class="btn btn-sm btn-danger w-100">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('dashboard.rooms.includes.delete-discipline', ['discipline' => $discipline])
                                            @include('dashboard.rooms.includes.edit-discipline', ['discipline' => $discipline])
                                        @empty
                                            <h6>Nenhum registro até o momento!</h6>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection