@extends('layouts.master')

@section('content')
    @can('students.index')
        <div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                        </li>
                                        <li class="breadcrumb-item active"
                                            aria-current="page">Alunos
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <select name="filterStudent" id="" class="form-select form-select-sm"
                                        onchange="location = this.value;">
                                    <option value="">Turma</option>
                                    @foreach($rooms as $room)
                                        <option value="{{route('dashboard.students.filterStudentRoom', $room->id)}}">
                                            <a href="{{route('dashboard.students.filterStudentRoom', $room->id)}}">{{$room->name}}</a>
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <form method="GET" action="{{route('dashboard.students.index')}}">

                                    <div class="input-group mb-3">
                                        <input id="title" name="searchStudentRa" type="search"
                                               class="form-control form-control-sm" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-outline-primary btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                <a href="{{route('dashboard.students.index')}}" class="btn btn-sm btn-primary w-100">Todos</a>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary w-100">Painel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Turma</th>
                                            <th style="width: 1rem">Nº</th>
                                            <th>Nome</th>
                                            <th>Tutor</th>
                                            <th style="width: 4rem">RA</th>
                                            <th style="width: 1rem">D</th>
                                            <th style="width: 3rem">Data Nasc</th>
                                            <th style="width: 3rem">Idade</th>
                                            <th style="width: 17rem">E-mail Google</th>
                                            <th style="width: 3rem">Status</th>
                                            <th style="width: 3rem">Editar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($students as $student)
                                            <tr>
                                                <td>{{$student->room->name}}</td>
                                                <td class="text-truncate text-center">{{$student->number}}</td>
                                                <td class="text-truncate">
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#imageStudentRoom{{$student->id}}"
                                                       style="cursor: pointer">
                                                        {{$student->name}}
                                                    </a>
                                                </td>
                                                <td class="text-truncate">
                                                    @if($student->tutoria)
                                                        {{$student->tutoria->tutor->user->name}}
                                                    @endif
                                                </td>
                                                <td class="text-truncate text-center">{{$student->number_ra}}</td>
                                                <td class="text-truncate text-center">{{$student->number_ra_digit}}</td>
                                                <td class="text-truncate text-center">
                                                    {{\Carbon\Carbon::parse($student->date_birth)->format('d/m/Y')}}
                                                </td>
                                                <td class="text-truncate text-center">
                                                    {{\Carbon\Carbon::parse($student->date_birth)->age}}
                                                </td>
                                                <td class="text-truncate">{{$student->email_google}}</td>
                                                <td class="text-truncate text-center">{{$student->student_situation}}</td>
                                                @can('students.edit')
                                                    <td class="text-truncate text-center">
                                                        @if($student->type == 'Regular' && $student->student_situation == 'Ativo')
                                                            <a href="{{route('dashboard.students.edit', $student->id)}}"
                                                               class="btn btn-sm btn-warning">
                                                                <i class="fa-solid fa-user-pen"></i>
                                                            </a>
                                                        @endif

                                                    </td>
                                                @endcan
                                            </tr>
                                            @include('dashboard.students.modals.image-student-room', ['student' =>$student])
                                        @empty
                                            <h6>Nenhum registro até o momento!</h6>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <div class="container-fluid d-print-none text-center">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="d-flex justify-content-end">
                                                    @if(isset($students))
                                                        {!! $students->appends(Request::all())->links() !!}
                                                    @else
                                                        {!! $students->links() !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection