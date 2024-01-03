@extends('layouts.conselho')

@section('content')
    <div class="container-fluid">
        @if(isset($search))
            <div class="row">
                {{--            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">--}}
                {{--                {{$students->links()}}--}}
                {{--            </div>--}}
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <table class="table table-sm table-bordered" style="font-size: 120%">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 2rem">{{$item->number}}</th>
                            <th>
                                <a data-bs-toggle="modal" data-bs-target="#imageStudentConselho{{$item->id}}"
                                   style="cursor: pointer;color: #CCCCCC !important;">
                                    {{$item->name}}
                                </a>
                                @include('dashboard.conselhos.modals.image-student-conselho', ['student' => $item])
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <table class="table table-sm table-bordered" style="font-size: 120%">
                        <thead>
                        <tr>
                            <th class="text-center">
                                {{$item->student_situation}}
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                {{--                @foreach($students as $student)--}}
                {{--                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">--}}
                {{--                        <table class="table table-sm table-bordered" style="font-size: 120%">--}}
                {{--                            <thead>--}}
                {{--                            <tr>--}}
                {{--                                <th class="text-center" style="width: 2rem">{{$student->number}}</th>--}}
                {{--                                <th>--}}
                {{--                                    <a data-bs-toggle="modal" data-bs-target="#imageStudentConselho{{$student->id}}"--}}
                {{--                                       style="cursor: pointer;color: #CCCCCC !important;">--}}
                {{--                                        {{$student->name}}--}}
                {{--                                    </a>--}}
                {{--                                    @include('dashboard.conselhos.modals.image-student-conselho', ['student' => $student])--}}
                {{--                                </th>--}}
                {{--                            </tr>--}}
                {{--                            </thead>--}}
                {{--                        </table>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">--}}
                {{--                        <table class="table table-sm table-bordered" style="font-size: 120%">--}}
                {{--                            <thead>--}}
                {{--                            <tr>--}}
                {{--                                <th class="text-center">{{$student->student_situation}}</th>--}}
                {{--                            </tr>--}}
                {{--                            </thead>--}}
                {{--                        </table>--}}
                {{--                    </div>--}}
                {{--                @endforeach--}}
            </div>
        @endif
        <table class="table table-sm table-bordered table-hover">
            <thead>
            <tr>
                @include('dashboard.conselhos.partials.bloquear-room')
            </tr>
            </thead>
            @if(isset($search))
                @include('dashboard.conselhos.partials.thead-table-conselho', ['item' => $item])
                <form action="{{route('dashboard.students.conselho.escola.conselhoUpdateStudent')}}" method="POST">
                    @csrf @method('PUT')
                    <tbody>
                    @foreach($fechamentos as $fechamento)
                        <input type="hidden" name="id[]" value="{{$fechamento->id}}">
                        <input type="hidden" name="tipo_ensino_id[]" value="{{$fechamento->tipo_ensino_id}}">
                        <input type="hidden" name="serie_id[]" value="{{$fechamento->serie_id}}">
                        <input type="hidden" name="room_id[]" value="{{$fechamento->room_id}}">
                        <input type="hidden" name="discipline_id[]" value="{{$fechamento->discipline_id}}">
                        <tr>
                            <td data-bs-toggle="modal"
                                data-bs-target="#disciplineInformations{{$fechamento->discipline->id}}"
                                style="cursor: pointer">
                                <span>{{$fechamento->discipline->name}}</span>
                            </td>
                            @include('dashboard.conselhos.modals.discipline-imformations', ['fechamento', $fechamento])
                            @include('dashboard.conselhos.partials.inputs-table-conselho-primeiro-bimestre', ['fechamento', $fechamento])
                            @include('dashboard.conselhos.partials.inputs-table-conselho-segundo-bimestre', ['fechamento', $fechamento])
                            @include('dashboard.conselhos.partials.inputs-table-conselho-terceiro-bimestre', ['fechamento', $fechamento])
                            @include('dashboard.conselhos.partials.inputs-table-conselho-quarto-bimestre', ['fechamento', $fechamento])
                            @include('dashboard.conselhos.partials.inputs-table-conselho-quinto-conceito', ['fechamento', $fechamento])
                            <td class="text-center">
                                <input type="text" style="width: 2.0rem" name="t_f_bs[]"
                                       value="{{$fechamento->t_f_bs,old('t_f_bs')}}"
                                       class="table-target text-secondary" readonly>
                            </td>
                            <td class="text-center">
                                <input type="text" style="width: 2.0rem" name="t_f_comp[]"
                                       value="{{$fechamento->t_f_comp}}"
                                       class="table-target text-secondary" readonly>
                            </td>
                            <td class="text-center">
                                <input type="text" style="width: 2.0rem" name="t_f_ano[]"
                                       value="{{$fechamento->t_f_ano}}"
                                       class="table-target text-secondary" readonly>
                            </td>
                            <td class="text-center">
                                @if($fechamento->t_a_d_ano >= 1)
                                    <input type="text" style="width: 2.0rem" name="t_a_d_ano[]"
                                           value="{{$fechamento->t_a_d_ano}}"
                                           class="table-target text-secondary" min="1" max="1000">
                                @else
                                    <input type="text" style="width: 2.0rem" name="t_a_d_ano[]"
                                           value="1"
                                           class="table-target text-secondary" min="1" max="1000">
                                @endif

                            </td>
                            <td class="text-center">
                                @if($fechamento->t_f_porcentagem_ano >= 75)
                                    <input type="text" style="width: 3.0rem" name="t_f_porcentagem_ano[]"
                                           value="{{intval($fechamento->t_f_porcentagem_ano)}}%"
                                           class="table-target text-danger" readonly>
                                @elseif($fechamento->t_f_porcentagem_ano > 29 && $fechamento->t_f_porcentagem_ano < 74)
                                    <input type="text" style="width: 3.0rem" name="t_f_porcentagem_ano[]"
                                           value="{{intval($fechamento->t_f_porcentagem_ano)}}%"
                                           class="table-target text-warning" readonly>
                                @elseif($fechamento->t_f_porcentagem_ano < 75)
                                    <input type="text" style="width: 3.0rem" name="t_f_porcentagem_ano[]"
                                           value="{{intval($fechamento->t_f_porcentagem_ano)}}%"
                                           class="table-target text-secondary" readonly>
                                @endif
                            </td>
                            <td hidden="" class="text-center">
                                <input style="border: 0 !important;"
                                       value="{{$fechamento->resultado_final_student}}"
                                       type="text" class="table-target text-secondary result">
                            </td>
                        </tr>
                        {{--                        @endif--}}

                    @endforeach
                    {{--                    @endforeach--}}
                    </tbody>
                    <tbody>
                    <tr>
                        <td>
                            <select name="resultado_final_student"
                                    class="form-select form-select-sm resultado_final_student">
                                @if(isset($result->resultado_final_student))
                                    <option value="">{{$result->resultado_final_student}}</option>
                                @else
                                    <option value="">Selecionar o status</option>
                                @endif
                                <option value="Promovido">Promovido</option>
                                <option value="Promovido pelo Conselho">Promovido pelo Conselho</option>
                                <option value="Promovido parcialmente">Promovido parcialmente</option>
                                <option value="Retido por frequência">Retido por frequência</option>
                                <option value="Retido por rendimento insuficiente">Retido por rendimento
                                    insuficiente
                                </option>
                                <option value="Promovido pelo Conselho ETEC">Promovido pelo Conselho ETEC</option>
                                <option value="Promovido parcialmente ETEC">Promovido parcialmente ETEC</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" id="send"
                                    class="btn btn-sm btn-success w-100 selectResult">
                                Salvar
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </form>
            @endif
        </table>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function update() {
            var select = document.getElementById('language');
            var option = select.options[select.selectedIndex];

            document.getElementById('value').value = option.value;
            document.getElementById('text').value = option.text;
        }

        update();
    </script>
    <script>
        const selectElement = document.querySelector(".resultado_final_student");
        const result = document.querySelector(".result");

        selectElement.addEventListener("change", (event) => {
            // alert(result.textContent = `You like ${event.target.value}`);
            result.textContent = `You like ${event.target.value}`;
        });
        // function resultFinalStudent(){
        //     $(document).ready(function() {
        //         $("select.selectVal").change(function() {
        //             let selectedItem = $(this).children("option:selected").val();
        //             alert("You have selected the name - " + selectedItem);
        //             // document.getElementById('selectResult').innerHTML = selectedItem;
        //         });
        //     });
        // }

    </script>
@endpush