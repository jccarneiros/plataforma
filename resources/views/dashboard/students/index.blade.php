@extends('layouts.master')

@section('content')
    @can('students.index')
        <div class="container-fluid">
            <!-- início do preloader -->
            <div id="spinner" class="text-center" style="vertical-align: middle"></div>
            <div class="card" id="form">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                                href="{{route('dashboard.series.rooms', $room->serie->id)}}">Turmas</a>
                                    </li>
                                    <li class="breadcrumb-item active"
                                        aria-current="page">{{$room->tipoEnsino->name}} / {{$room->serie->name}}
                                        / {{$room->name}} / Alunos / {{$room->students->count()}}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            @can('students.create')
                                @include('components.students.includes.import-students',['room' =>$room])
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @can('students.create')
                            {{--                                @include('components.students.includes.create',['room' =>$room])--}}
                        @endcan
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                                            <th style="width: 4rem">Status</th>
                                            <th style="width: 6rem">Remanejar</th>
                                            {{--                                                <th style="width: 3rem">Editar</th>--}}
                                            <th style="width: 3rem">Excluir</th>
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
                                                <td class="text-truncate text-center">{{$student->student_situation}}</td>
                                                @can('students.edit')
                                                    <td class="text-truncate text-center">
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Remanejar_Student' . $student->id }}"
                                                           class="btn btn-sm btn-warning">
                                                            Remanejar
                                                        </a>
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
                                                @can('students.delete')
                                                    <td class="text-center">
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Delete_Student' . $student->id }}"
                                                           class="btn btn-sm btn-danger w-100">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                @endcan
                                            </tr>
                                            @can('students.delete')
                                                @include('components.students.includes.delete', ['student' => $student])
                                            @endcan
                                            {{--                                                @can('students.edit')--}}
                                            {{--                                                    @include('components.students.includes.edit', ['student' => $student])--}}
                                            {{--                                                @endcan--}}
                                            @can('students.edit')
                                                @include('components.students.includes.remanejar', ['student' => $student])
                                            @endcan
                                            @include('components.students.modals.image-student-room', ['student' =>$student])
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
            </div>
        </div>
    @endcan
@endsection