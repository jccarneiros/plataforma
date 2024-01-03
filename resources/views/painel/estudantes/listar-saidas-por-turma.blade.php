@extends('layouts.register-outputs-students')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <select name="room" class="form-select form-select-sm border-1 border-primary"
                        onchange="location = this.value;">
                    <option selected>Selecione o mês</option>
                    @foreach ($months as $month)
                        <option value="{{route('painel.estudantes.filtrar.saidas', [$segmentRoom,$month])}}">
                            <a href="{{route('painel.estudantes.filtrar.saidas', [$segmentRoom,$month])}}" target="_blank">{{$month}}</a>
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                <div class="btn-group w-100" role="group" aria-label="Basic toggle button group">
                    <label class="btn btn-sm btn-outline-primary w-100" for="btncheck1">Listando registros das saidas</label>
                    <label class="btn btn-sm btn-outline-primary w-100" for="btncheck2">Turma: {{$segmentRoom}}</label>
                    <label class="btn btn-sm btn-outline-primary w-100" for="btncheck3">Mês: {{$segmentMonth}}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="font-size: 90% !important;">
        <div class="row">
{{--            <div class="table-wrapper">--}}
                <table class="table table-sm table-bordered table-hover">
                    <thead class="sticky">
                    <tr>
                        <th scope="col" style="width: 1rem" class="text-center">Nº</th>
                        {{--                        <th scope="col">Nome</th>--}}
                        @foreach($dates as $date)
                            <th scope="col" class="text-center" style="width: 1rem">{{$date->format('d')}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td class="text-center" style="cursor: pointer"
                                data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{$student->name}}">
                                {{$student->number}}
                            </td>
                            {{--                            <td style="font-size: 80% !important;">{{$student->name}}</td>--}}
                            @foreach($student->outputs as $outputStudent)
                                @if($student->number == $outputStudent->student->number && $outputStudent->month_name == $segmentMonth)
                                    @include('painel.estudantes.partials.table-saidas-dias', ['output' =>$outputStudent])
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
{{--            </div>--}}
        </div>
    </div>
@endsection

