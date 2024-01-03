@extends('layouts.conselho')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.students.conselho.teacher.index')}}">Turmas</a>
                                </li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{$room->tipoEnsino->name}} / {{$room->serie->name}}
                                    / {{$room->name}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <form action="{{route('dashboard.students.conselho.teacher.room', $room->id)}}"
                                  method="GET">
                                <select name="search" class="form-select form-control-sm"
                                        onchange="this.form.submit()">
                                    <option value="">Selecione</option>
                                    @foreach($room->students as $student)
                                        <option value="{{$student->number_ra}}" {{$student->number_ra == $search ? 'selected': ''}}>
                                            {{$student->number}} | {{$student->name}}
                                        </option>

                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            @if(isset($search))
                                <a data-bs-toggle="modal"
                                   data-bs-target="#imageStudentFechamentoTeacher{{$item->id}}"
                                   style="cursor: pointer;color: #CCCCCC !important;">
                                    {{$item->name}}
                                </a>
                                @include('dashboard.teachers.conselho.modals.image-student-fechamento-teacher', ['student' => $item])
                            @else
                                <span style="color: #CCCCCC !important;">Selecione um estudante na lista!</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($search))
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="1" class="text-center text-white fw-bold">{{$room->name}}</th>
                                        <th colspan="4" class="text-center"
                                            style="background-color: #e57373 !important;color: #ffffff !important;">1ºB
                                        </th>
                                        <th colspan="4" class="text-center"
                                            style="background-color: #ba68c8 !important;color: #ffffff !important;">2ºB
                                        </th>
                                        <th colspan="4" class="text-center"
                                            style="background-color: #4db6ac !important;color: #ffffff !important;">3ºB
                                        </th>
                                        <th colspan="4" class="text-center"
                                            style="background-color: #7986cb !important;color: #ffffff !important;">4ºB
                                        </th>
                                        <th colspan="1" class="text-center"
                                            style="background-color: #ff8a65 !important;color: #ffffff !important;">5ºC
                                        </th>
                                        @if (isset($result) && $result->resultado_final_student !== null)
                                            <th colspan="6" class="text-center text-uppercase"
                                                style="background-color: #607d8b  !important;color: #ffffff !important;">
                                                {{$result->resultado_final_student}}
                                            </th>
                                        @else
                                            <th colspan="6" class="text-center text-uppercase"
                                                style="background-color: #607d8b  !important;color: #ffffff !important;">
                                                Resultado
                                            </th>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th class="text-center">Disciplinas</th>
                                        <th class="text-center"
                                            style="background-color: #e57373 !important;color: #ffffff !important;">
                                            N
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #e57373 !important;color: #ffffff !important;">
                                            F
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #e57373 !important;color: #ffffff !important;">
                                            F.C.
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #e57373 !important;color: #ffffff !important;">
                                            A.D.
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #ba68c8 !important;color: #ffffff !important;">
                                            N
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #ba68c8 !important;color: #ffffff !important;">
                                            F
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #ba68c8 !important;color: #ffffff !important;">
                                            F.C
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #ba68c8 !important;color: #ffffff !important;">
                                            A.D.
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #4db6ac !important;color: #ffffff !important;">
                                            N
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #4db6ac !important;color: #ffffff !important;">
                                            F
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #4db6ac !important;color: #ffffff !important;">
                                            F.C
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #4db6ac !important;color: #ffffff !important;">
                                            A.D.
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #7986cb !important;color: #ffffff !important;">
                                            N
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #7986cb !important;color: #ffffff !important;">
                                            F
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #7986cb !important;color: #ffffff !important;">
                                            F.C
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #7986cb !important;color: #ffffff !important;">
                                            A.D.
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #ff8a65 !important;color: #ffffff !important;">
                                            N
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #607d8b !important;color: #ffffff !important;">
                                            T.F.BS.
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #607d8b !important;color: #ffffff !important;">
                                            T.F.C.
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #607d8b !important;color: #ffffff !important;">
                                            T.F.A.
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #607d8b !important;color: #ffffff !important;">
                                            T.A.D.A
                                        </th>
                                        <th class="text-center"
                                            style="background-color: #607d8b !important;color: #ffffff !important;">
                                            F. %
                                        </th>
                                        <th hidden scope="col" class="text-center text-uppercase">
                                            Resultado
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fechamentos as $fachamento)
                                        <div>
                                            <input type="hidden" name="id[]" value="{{$fachamento->id}}">
                                            <input type="hidden" name="discipline_id[]"
                                                   value="{{$fachamento->discipline_id}}">
                                            <input type="hidden" name="student_id[]"
                                                   value="{{$fachamento->student_id}}">
                                        </div>
                                        <tr>
                                            <td data-bs-toggle="modal"
                                                data-bs-target="#disciplineInformations{{$fachamento->discipline->id}}"
                                                style="cursor: pointer">
                                                <span>{{$fachamento->discipline->name}}</span>
                                            </td>
                                            @include('dashboard.teachers.conselho.modals.discipline-imformations', ['nota' => $fachamento])
                                            @include('dashboard.teachers.conselho.inputs-table-fechamento-primeiro-bimestre', ['nota' => $fachamento])
                                            @include('dashboard.teachers.conselho.inputs-table-fechamento-segundo-bimestre', ['nota' => $fachamento])
                                            @include('dashboard.teachers.conselho.inputs-table-fechamento-terceiro-bimestre', ['nota' => $fachamento])
                                            @include('dashboard.teachers.conselho.inputs-table-fechamento-quarto-bimestre', ['nota' => $fachamento])
                                            @include('dashboard.teachers.conselho.inputs-table-fechamento-quinto-conceito', ['nota' => $fachamento])
                                            <td class="text-center">
                                                <input type="text" style="width: 2.0rem" name="t_f_bs[]"
                                                       value="{{$fachamento->t_f_bs,old('t_f_bs')}}"
                                                       class="table-target text-secondary" readonly>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" style="width: 2.0rem" name="t_f_comp[]"
                                                       value="{{$fachamento->t_f_comp}}"
                                                       class="table-target text-secondary" readonly>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" style="width: 2.0rem" name="t_f_ano[]"
                                                       value="{{$fachamento->t_f_ano}}"
                                                       class="table-target text-secondary" readonly>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" style="width: 2.5rem" readonly name="t_a_d_ano[]"
                                                       id="t_a_d_ano" value="{{$fachamento->t_a_d_ano}}"
                                                       class="table-target text-secondary" min="1" max="1000">
                                            </td>
                                            <td class="text-center">
                                                @if($fachamento->t_f_porcentagem_ano >= 75)
                                                    <input type="text" style="width: 3.0rem"
                                                           name="t_f_porcentagem_ano[]"
                                                           value="{{intval($fachamento->t_f_porcentagem_ano)}}%"
                                                           class="table-target text-danger" readonly>
                                                @elseif($fachamento->t_f_porcentagem_ano > 29 && $fachamento->t_f_porcentagem_ano < 74)
                                                    <input type="text" style="width: 3.0rem"
                                                           name="t_f_porcentagem_ano[]"
                                                           value="{{intval($fachamento->t_f_porcentagem_ano)}}%"
                                                           class="table-target text-warning" readonly>
                                                @elseif($fachamento->t_f_porcentagem_ano < 75)
                                                    <input type="text" style="width: 3.0rem"
                                                           name="t_f_porcentagem_ano[]"
                                                           value="{{intval($fachamento->t_f_porcentagem_ano)}}%"
                                                           class="table-target text-secondary" readonly>
                                                @endif
                                            </td>
                                            <td hidden="" class="text-center">
                                                <input style="border: 0 !important;"
                                                       type="text"
                                                       name="resultado_final_student[]"
                                                       value="{{$fachamento->resultado_final_student}}"
                                                       class="table-target text-secondary"
                                                       placeholder="{{$fachamento->resultado_final_student}}" readonly>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

