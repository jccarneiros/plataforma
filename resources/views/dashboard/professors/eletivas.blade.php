@extends('layouts.master')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-uppercase mb-2">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                                href="{{route('dashboard.professors.index')}}">Professores</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Professor: {{$professor->user->name}}
                                        /
                                        Alunos
                                        : {{$professor->students->count()}}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <a href="{{route('dashboard.professors.eletivas.studentsEletivaPdf', $professor->id)}}"
                               class="btn btn-sm btn-warning" target="_blank">
                                Gerar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @can('professors.edit')
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                        <form action="{{route('dashboard.salas.updateLimitProfessor', $professor->id)}}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="id" value="{{$professor->id}}">
                            <select name="limit_eletiva_students" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                <option value="0">Limite</option>
                                @foreach(range(1, 50) as $number)
                                    <option value="{{$number}}" {{$professor->limit_eletiva_students == $number ? 'selected' : ''}}>{{$number}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <form action="{{route('dashboard.salas.updateStatusProfessor', $professor->id)}}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="id" value="{{$professor->id}}">
                            <select name="status_eletiva" class="form-select form-control-sm"
                                    onchange="this.form.submit()" style="font-size: 90% !important;">
                                @if($professor->status_eletiva !== 1)
                                    <option value="{{$professor->status_eletiva}}">Inativo</option>
                                    <option value="1">Ativar</option>
                                @else
                                    <option value="{{$professor->status_eletiva}}">Ativo</option>
                                    <option value="0">Inativar</option>
                                @endif
                            </select>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <form action="{{route('dashboard.professors.updateSala', $professor->id)}}" method="POST">
                            @csrf @method('PUT')
                            <div class="row">
                                <input type="hidden" name="id" value="{{$professor->id}}">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                    <select name="sala_id" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                        <option value="{{$professor->sala_id}}">{{$professor->sala->name}}</option>
                                        @foreach($salas as $sala)
                                            <option value="{{$sala->id}}" {{$professor->sala_id == $sala->id ? 'selected' : ''}}>{{$sala->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                        Professor: {{$professor->user->name}}
                    </div>
                </div>
            @endcan
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Limite: {{$professor->limit_eletiva_students	}}</th>
                            <th>Alunos: {{$professor->students->count()}}</th>
                            <th>
                                <a href="{{route('dashboard.professors.index')}}"
                                   class="btn btn-sm btn-secondary w-100">
                                    Voltar
                                </a>
                            </th>
                        </tr>
                        </thead>
                    </table>
                    @can('eletivas.create')
                        <form action="{{route('dashboard.professors.storeStudentEletivas')}}" method="POST">
                            @csrf
                            <input type="hidden" name="professor_id" value="{{$professor->id}}">
                            <select name="student_id" class="form-select form-select-sm" multiple size="20"
                                    onchange="this.form.submit()">
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">
                                        {{$student->room->name}} - {{$student->name}}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    @endcan
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
                                <th style="width: 5rem">Data Nasc.</th>
                                <th style="width: 3rem">Idade</th>
                                <th style="width: 17rem">E-mail Google</th>
                                @can('eletivas.delete')
                                    <th style="width: 2rem">Excluír</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($eletivas as $eletiva)
                                <tr>
                                    <td class="text-truncate text-center">{{$eletiva->student->room->name}}</td>
                                    <td class="text-truncate text-center">{{$eletiva->student->number}}</td>
                                    <td class="text-truncate">
                                        <a data-bs-toggle="modal"
                                           data-bs-target="#imageStudentEletiva{{$eletiva->id}}"
                                           style="cursor: pointer">
                                            {{$eletiva->student->name}}
                                        </a>
                                    </td>
                                    <td class="text-truncate text-center">{{$eletiva->student->number_ra}}</td>
                                    <td class="text-truncate text-center">{{$eletiva->student->number_ra_digit}}</td>
                                    <td class="text-truncate text-center">
                                        {{\Carbon\Carbon::parse($eletiva->student->date_birth)->format('d/m/Y')}}
                                    </td>
                                    <td class="text-truncate text-center">
                                        {{\Carbon\Carbon::parse($eletiva->student->date_birth)->age}}
                                    </td>
                                    <td class="text-truncate">
                                        {{$eletiva->student->email_google}}
                                    </td>
                                    @can('eletivas.delete')
                                        <td class="text-truncate text-center">
                                            <form action="{{route('dashboard.eletivas.delete', $eletiva->id)}}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-user-xmark"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                                @include('dashboard.professors.modals.image-student', ['eletiva' => $eletiva])
                            @empty
                                <td colspan="5" class="text-danger">Nenhum registro encontrado!</td>
                            @endforelse
                            </tbody>
                        </table>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </div>
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

