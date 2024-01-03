<div class="table-wrapper">
    <div class="row">
    <table class="table table-sm table-bordered table-hover">
        <thead class="sticky">
        {{--                                            TOP TABLE FECHAMENTO--}}
        <tr>
            <th scope="col" colspan="2" class="text-center text-uppercase">
                Estudantes
            </th>
            <th scope="col" colspan="3" class="text-center text-uppercase"
                style="background-color: #e57373 !important;color: #ffffff !important;">
                1ºB
            </th>
            <th scope="col" colspan="3" class="text-center text-uppercase"
                style="background-color: #ba68c8 !important;color: #ffffff !important;">
                2ºB
            </th>
            <th scope="col" colspan="3" class="text-center text-uppercase"
                style="background-color: #4db6ac !important;color: #ffffff !important;">
                3ºB
            </th>
            <th scope="col" colspan="3" class="text-center text-uppercase"
                style="background-color: #7986cb !important;color: #ffffff !important;">
                4ºB
            </th>
            <th scope="col" colspan="1" class="text-center text-uppercase"
                style="background-color: #ff8a65 !important;color: #ffffff !important;">
                5ºC
            </th>
            <th scope="col" colspan="6" class="text-center text-uppercase"
                style="background-color: #607d8b !important;color: #ffffff !important;">
                FECHAMENTO
            </th>
        </tr>
        <tr>
            <th scope="col" style="width: 1rem" class="text-center text-uppercase">
                Nº
            </th>
            <th scope="col" class="text-center text-uppercase">Nome</th>
            {{--                                                PRIMEIRO BIMESTRE--}}
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #e57373 !important;color: #ffffff !important;">
                N
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #e57373 !important;color: #ffffff !important;">
                F
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #e57373 !important;color: #ffffff !important;">
                F.c
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #e57373 !important;color: #ffffff !important;">
                A.P
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #e57373 !important;color: #ffffff !important;">
                A.D
            </th>
            {{--                                                SEGUNDO BIMESTRE--}}
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #ba68c8 !important;color: #ffffff !important;">
                N
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #ba68c8 !important;color: #ffffff !important;">
                F
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #ba68c8 !important;color: #ffffff !important;">
                F.C
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #ba68c8 !important;color: #ffffff !important;">
                A.P
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #ba68c8 !important;color: #ffffff !important;">
                A.D
            </th>
            {{--                                                TERCEIRO BIMESTRE--}}
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #4db6ac !important;color: #ffffff !important;">
                N
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #4db6ac !important;color: #ffffff !important;">
                F
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #4db6ac !important;color: #ffffff !important;">
                F.C
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #4db6ac !important;color: #ffffff !important;">
                A.P
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #4db6ac !important;color: #ffffff !important;">
                A.D
            </th>
            {{--                                                QUARTO BIMESTRE--}}
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #7986cb !important;color: #ffffff !important;">
                N
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #7986cb !important;color: #ffffff !important;">
                F
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #7986cb !important;color: #ffffff !important;">
                F.C
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #7986cb !important;color: #ffffff !important;">
                A.P
            </th>
            <th scope="col" class="text-center text-uppercase" hidden
                style="background-color: #7986cb !important;color: #ffffff !important;">
                A.D
            </th>
            {{--                                                QUINTO CONCEITO--}}
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #ff8a65 !important;color: #ffffff !important;">
                N
            </th>
            {{--                                                TOTAL DE AULAS DADAS ANO--}}
            <th hidden scope="col" class="text-center text-uppercase"
                style="background-color: #607d8b !important;color: #ffffff !important;">
                T.A.D.A.
            </th>
            {{--                                                FECHAMENTO--}}
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #607d8b !important;color: #ffffff !important;">
                T.F.BS.
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #607d8b !important;color: #ffffff !important;">
                T.F.C.
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #607d8b !important;color: #ffffff !important;">
                T.F.A.
            </th>
            <th scope="col" class="text-center text-uppercase"
                style="background-color: #607d8b !important;color: #ffffff !important;">
                F. %
            </th>
        </tr>
        {{--                                            TOP TABLE FECHAMENTO--}}
        </thead>
        {{--                                        @foreach($students as $student)--}}
        @foreach($fechamentos as $fechamento)
            <tbody>
            <tr>
                <td class="text-center text-truncate">{{$fechamento->student->number}}</td>
                <td class="text-truncate">
                    <a data-bs-toggle="modal"
                       data-bs-target="#imageStudentFechamentoTeacher{{$fechamento->student->id}}"
                       style="cursor: pointer">
                        {{$fechamento->student->name}}
                    </a>
                </td>

                @include('dashboard.teachers.conselho.modals.image-student-fechamento-teacher', ['student' => $fechamento->student])
                <input type="hidden" name="id[]" value="{{$fechamento->id}}">
                <input type="hidden" name="discipline_id[]"
                       value="{{$discipline->id}}">
                <input type="hidden" name="student_id[]"
                       value="{{$fechamento->student->id}}">
                @include('dashboard.teachers.fechamentos.includes.inputs-table-fechamento-primeiro-bimestre')
                @include('dashboard.teachers.fechamentos.includes.inputs-table-fechamento-segundo-bimestre')
                @include('dashboard.teachers.fechamentos.includes.inputs-table-fechamento-terceiro-bimestre')
                @include('dashboard.teachers.fechamentos.includes.inputs-table-fechamento-quarto-bimestre')
                @include('dashboard.teachers.fechamentos.includes.inputs-table-fechamento-quinto-conceito')
                {{--                                                    TOTAL DE AULAS DADAS NO ANO--}}
                <td>
                    <input type="text" name="t_f_bs[]"
                           value="{{$fechamento->t_f_bs}}"
                           style="width: 2.5rem" min="0" max="1000"
                           class="table-target text-secondary"
                           readonly>
                </td>
                <td>
                    <input type="text" style="width: 2.5rem" name="t_f_comp[]"
                           class="table-target text-secondary"
                           value="{{$fechamento->t_f_comp}}"
                           readonly>
                </td>
                <td>
                    <input type="text" name="t_f_ano[]"
                           class="table-target text-secondary"
                           style="width: 2.5rem"
                           value="{{$fechamento->t_f_ano}}"
                           readonly>
                </td>
                <td class="text-center">
                    @if($fechamento->t_f_porcentagem_ano >= 75)
                        <input type="text" style="width: 3.0rem"
                               name="t_f_porcentagem_ano[]"
                               value="{{intval($fechamento->t_f_porcentagem_ano)}}%"
                               class="table-target text-danger" readonly>
                    @elseif($fechamento->t_f_porcentagem_ano > 24 && $fechamento->t_f_porcentagem_ano < 74)
                        <input type="text" style="width: 3.0rem"
                               name="t_f_porcentagem_ano[]"
                               value="{{intval($fechamento->t_f_porcentagem_ano)}}%"
                               class="table-target text-warning" readonly>
                    @elseif($fechamento->t_f_porcentagem_ano < 75)
                        <input type="text" style="width: 3.0rem"
                               name="t_f_porcentagem_ano[]"
                               value="{{intval($fechamento->t_f_porcentagem_ano)}}%"
                               class="table-target text-secondary" readonly>
                    @endif
                </td>
                <td hidden>
                    <input type="text" name="t_a_d_ano[]"
                           value="{{$fechamento->t_a_d_ano}}"
                           style="width: 2.5rem" min="0" max="1000"
                           class="table-target text-secondary"
                           readonly>
                </td>
            </tr>

            </tbody>
        @endforeach
        {{--                                        @endforeach--}}
    </table>
</div>
</div>