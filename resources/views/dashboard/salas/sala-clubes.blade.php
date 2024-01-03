@extends('layouts.student')

@section('content')
    <div>
        <div class="container-fluid">
            @if(isset($sala->president))
                <div class="row mb-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        {{$sala->name}}
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        @include('components.salas.includes.edit-presidente-clube', ['sala' => $sala])
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        @include('components.salas.includes.edit-limit-clube', ['sala' => $sala])
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        @include('components.salas.includes.edit-status-clube', ['sala' => $sala])
                    </div>
                </div>
                <div class="row" style="font-size: 85%!important;">
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Limite: {{$sala->limit_clube_students	}}</th>
                                <th>Alunos: {{$sala->clubes->count()}}</th>
                                <th>
                                    <a href="{{route('dashboard.salas.index')}}" class="btn btn-sm btn-secondary w-100">
                                        Voltar
                                    </a>
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <form action="{{route('dashboard.salas.storeStudentClube')}}" method="POST">
                            @csrf
                            @foreach($sala->clubes as $clube)
                                @if(isset($clube->name_clube))
                                    <input type="text" name="name_clube" class="form-control form-control-sm" value="{{$clube->name_clube}}">
                                @else
                                    <input type="text" name="name_clube" class="form-control form-control-sm" placeholder="Nome do clube">
                                @endif
                            @endforeach
                            <input type="hidden" name="sala_id" value="{{$sala->id}}">
                            <input type="hidden" name="president_id" value="{{$sala->president_id}}">
                            <select name="student_id" class="form-select form-select-sm" multiple size="30"
                                    onchange="this.form.submit()">
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">
                                        {{$student->room->name}} - {{$student->name}}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                        <div class="fixTableHead">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 2rem">Turma</th>
                                    <th style="width: 1rem">Nº</th>
                                    <th>Nome</th>
                                    <th style="width: 5rem">RA</th>
                                    <th style="width: 1rem">D</th>
                                    <th style="width: 3rem">Aniversário</th>
                                    <th style="width: 17rem">E-mail Google</th>
                                    <th style="width: 2rem">Excluír</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clubes as $clube)
                                    <tr>
                                        <td class="text-truncate text-center">{{$clube->student->room->name}}</td>
                                        <td class="text-truncate text-center">{{$clube->student->number}}</td>
                                        <td class="text-truncate">
                                            <a data-bs-toggle="modal" data-bs-target="#imageStudentClube{{$clube->id}}"
                                               style="cursor: pointer">
                                                {{$clube->student->name}}
                                            </a>
                                        </td>
                                        <td class="text-truncate text-center">{{$clube->student->number_ra}}</td>
                                        <td class="text-truncate text-center">{{$clube->student->number_ra_digit}}</td>
                                        <td class="text-truncate text-center">
                                            {{\Carbon\Carbon::parse($clube->student->date_birth)->format('d/m/Y')}}
                                        </td>
                                        <td class="text-truncate">{{$clube->student->email_google}}</td>
                                        <td class="text-truncate text-center">
                                            <form action="{{route('dashboard.clubes.delete', $clube->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-user-xmark"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('components.students.modals.image-student-clube', ['student' => $clube])
                                @empty
                                    <td colspan="5" class="text-danger">Nenhum registro encontrado!</td>
                                @endforelse
                                </tbody>
                            </table>
                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mb-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                        {{$sala->name}}
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        @include('components.salas.includes.edit-presidente-clube', ['sala' => $sala])
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 border border-1">
                        Limite: {{$sala->limit_clube_students	}}
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 border border-1">
                        Alunos: {{$sala->clubes->count()}}
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 border border-1">
                        <a href="{{route('dashboard.salas.index')}}" class="btn btn-sm btn-secondary w-100">Voltar</a>
                    </div>
                </div>
            @endif


        </div>
    </div>
@endsection
@push('styles')
    <style>
        @media (max-width: 768px) {
            .hidden-mobile {
                display: none;
            }
        }
    </style>
    <style>
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

