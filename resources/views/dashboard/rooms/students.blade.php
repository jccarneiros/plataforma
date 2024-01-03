@extends('layouts.master')

@section('content')
    @can('students.index')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="with-line left">
                    {{$tipoEnsino->name}} / {{$room->serie->name}} / {{$room->name}} / Alunos
                </div>
            </div>
            <!-- início do preloader -->
            <div id="spinner" class="text-center" style="vertical-align: middle"></div>
            <div class="card" id="form">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
                            <div class="row mb-3">
                                @can('students.create')
                                    @include('dashboard.rooms.includes.import-students',['room' =>$room])
                                @endcan
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <a href="{{route('dashboard.students.export', $room->id)}}" class="btn btn-sm btn-secondary w-100">
                                Baixar Lista da Turma
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <a href="{{route('dashboard.rooms.gerar.qrcode.room.students.pdf', $room->id)}}" target="_blank"
                               class="btn btn-sm btn-info w-100">
                                Gerar Qrcode da Turma
                            </a>
                        </div>
                    </div>
                    {{--                    <div class="row mb-3">--}}
                    {{--                        @can('students.create')--}}
                    {{--                            @include('dashboard.rooms.includes.create-student',['room' =>$room])--}}
                    {{--                        @endcan--}}
                    {{--                    </div>--}}
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 1rem">Nº</th>
                                    <th>Nome</th>
                                    <th style="width: 5rem">RA</th>
                                    <th style="width: 1rem">D</th>
                                    <th style="width: 3rem">Aniversário</th>
                                    <th>E-mail Google</th>
                                    <th style="width: 10rem">Status</th>
                                    {{--                                        <th style="width: 6rem">Remanejar</th>--}}
                                    <th style="width: 3rem">Editar</th>
                                    {{--                                        <th style="width: 3rem">Excluir</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($room->students as $student)
                                    <tr>
                                        <td class="text-truncate text-center">{{$student->number}}</td>
                                        <td class="text-truncate">
                                            <a data-bs-toggle="modal" data-bs-target="#imageStudentRoom{{$student->id}}"
                                               style="cursor: pointer">
                                                {{$student->name}}
                                            </a>
                                        </td>
                                        <td class="text-truncate text-center">{{$student->number_ra}}</td>
                                        <td class="text-truncate text-center">{{$student->number_ra_digit}}</td>
                                        <td class="text-truncate text-center">
                                            {{\Carbon\Carbon::parse($student->date_birth)->format('d/m/Y')}}
                                        </td>
                                        <td class="text-truncate">{{$student->email_google}}</td>
                                        <td class="text-truncate text-center">
                                            <form action="{{route('dashboard.rooms.studentSituation.update', $room->id)}}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="tipo_ensino_id" value="{{$room->tipoEnsino->id}}">
                                                <input type="hidden" name="serie_id" value="{{$room->serie->id}}">
                                                <input type="hidden" name="room_id" value="{{$room->id}}">
                                                <input type="hidden" name="student_id" value="{{$student->id}}">
                                                <select name="student_situation" id="student_situation" class="form-select form-select-sm"
                                                        onchange="this.form.submit()">
                                                    <option value="{{$student->student_situation}}">{{$student->student_situation}}</option>
                                                    <option value="Ativo">Ativo</option>
                                                    <option value="Remanejamento">Remanejamento</option>
                                                    <option value="Transferido">Transferido</option>
                                                    <option value="Baixa - Transferência">Baixa - Transferência</option>
                                                    <option value="Não Comparecimento / Fora do Prazo">Não Comparecimento / Fora do Prazo</option>
                                                </select>
                                            </form>
                                        </td>
                                        {{--                                            @can('students.edit')--}}
                                        {{--                                                <td class="text-truncate text-center">--}}
                                        {{--                                                    <a data-bs-toggle="modal"--}}
                                        {{--                                                       data-bs-target="#{{ 'modal_Remanejar_Student' . $student->id }}"--}}
                                        {{--                                                       class="btn btn-sm btn-warning">--}}
                                        {{--                                                        Remanejar--}}
                                        {{--                                                    </a>--}}
                                        {{--                                                </td>--}}
                                        {{--                                            @endcan--}}
                                        @can('students.edit')
                                            <td class="text-truncate text-center">
                                                @if($student->student_situation == 'Ativo')
                                                    <a href="{{route('dashboard.students.edit', $student->id)}}"
                                                       class="btn btn-sm btn-warning" target="_blank">
                                                        <i class="fa-solid fa-user-pen"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        @endcan
                                        {{--                                                    @can('students.edit')--}}
                                        {{--                                                        <td class="text-truncate text-center">--}}
                                        {{--                                                            <a data-bs-toggle="modal"--}}
                                        {{--                                                               data-bs-target="#{{ 'modal_Edit_Student' . $student->id }}"--}}
                                        {{--                                                               class="btn btn-sm btn-warning">--}}
                                        {{--                                                                <i class="fa-solid fa-pen-to-square"></i>--}}
                                        {{--                                                            </a>--}}
                                        {{--                                                        </td>--}}
                                        {{--                                                    @endcan--}}
                                        {{--                                            @can('students.delete')--}}
                                        {{--                                                <td class="text-center">--}}
                                        {{--                                                    <a data-bs-toggle="modal"--}}
                                        {{--                                                       data-bs-target="#{{ 'modal_Delete_Student' . $student->id }}"--}}
                                        {{--                                                       class="btn btn-sm btn-danger w-100">--}}
                                        {{--                                                        <i class="fa-solid fa-trash"></i>--}}
                                        {{--                                                    </a>--}}
                                        {{--                                                </td>--}}
                                        {{--                                            @endcan--}}
                                    </tr>
                                    @can('students.delete')
                                        @include('dashboard.rooms.includes.delete-student', ['student' => $student])
                                    @endcan
                                    {{--                                                @can('students.edit')--}}
                                    {{--                                                    @include('dashboard.students.includes.edit', ['student' => $student])--}}
                                    {{--                                                @endcan--}}
                                    @can('students.edit')
                                        @include('dashboard.rooms.includes.remanejar', ['student' => $student])
                                    @endcan
                                    @include('dashboard.rooms.modals.image-student-room', ['student' =>$student])
                                @empty
                                    <h6>Nenhum registro até o momento!</h6>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection