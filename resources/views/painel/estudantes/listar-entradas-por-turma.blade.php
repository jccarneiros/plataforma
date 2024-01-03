@extends('layouts.register-entrances-students')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <select name="room" class="form-select form-select-sm border-1 border-primary"
                        onchange="location = this.value;">
                    <option selected>Selecione o mês</option>
                    @foreach ($months as $month)
                        <option value="{{route('painel.estudantes.filtrar.entradas', [$segmentRoom,$month])}}">
                            <a href="{{route('painel.estudantes.filtrar.entradas', [$segmentRoom,$month])}}" target="_blank">{{$month}}</a>
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                <div class="btn-group w-100" role="group" aria-label="Basic toggle button group">
                    <label class="btn btn-sm btn-outline-primary w-100" for="btncheck1">Listando registros das entradas</label>
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
                            @foreach($student->entrances as $entranceStudent)
                                @if($student->number == $entranceStudent->student->number && $entranceStudent->month_name == $segmentMonth)
                                    @include('painel.estudantes.partials.table-entradas-dias', ['entranceStudent' =>$entranceStudent])
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

    </div>
@endsection
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $("td").hover(function () {--}}
{{--            $(this)--}}
{{--                .parents("table")--}}
{{--                .find("col:eq(" + $(this).index() + ")")--}}
{{--                .toggleClass("hover");--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
@push('styles')
    <style>
        @media (max-width: 768px) {
            .hidden-mobile {
                display: none;
            }
        }
    </style>
    <style>
        .popover {
            border: none !important;
            --bs-popover-body-padding-y: 0.2rem;
            --bs-popover-bg: #ffffff;
            --bs-popover-border-width: 1px;
        }

        /* Fixed Headers */
        .fixTableHead {
            overflow-y: auto;
            height: 35rem;
        }

        .fixTableHead thead th {
            position: sticky;
            top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px 0;
        }

        th {
            background: #ABDD93;
        }

        tr, col {
            transition: all .3s;
        }

        tbody tr:hover {
            background-color: rgba(0, 140, 203, .2);
        }

        col.hover {
            background-color: rgba(0, 140, 203, .2);
        }
    </style>
@endpush
