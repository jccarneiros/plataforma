@extends('layouts.master')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-uppercase">
                    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Gerenciar Salas |
                                    Total: {{$salas->count()}}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    @include('dashboard.salas.includes.create')
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Alunos / Tutor</th>
                                <th>Alunos / Presidente do Clube</th>
                                <th>Alunos / Eletiva</th>
                                <th style="width: 3rem">Editar</th>
                                <th style="width: 3rem">Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($salas as $sala)
                                <tr>
                                    <td>{{$sala->name}}</td>
                                    <td>
                                        @if(isset($sala->tutor))
                                            <a href="{{route('dashboard.tutors.tutorias', $sala->tutor->id)}}" class="btn btn-sm btn-secondary"
                                               style="text-decoration: none;color: #cccccc;cursor: pointer" target="_blank">
                                                {{$sala->tutor->students->count()}}
                                            </a>
                                            {{$sala->tutor->user->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($sala->president))
                                            <a href="{{route('dashboard.presidents.clubes', $sala->president->id)}}" class="btn btn-sm btn-secondary"
                                               style="text-decoration: none;color: #cccccc;cursor: pointer" target="_blank">
                                                {{$sala->president->students->count()}}
                                            </a>
                                            {{$sala->president->user->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($sala->professor))
                                            <a href="{{route('dashboard.professors.eletivas', $sala->professor->id)}}" class="btn btn-sm btn-secondary"
                                               style="text-decoration: none;color: #cccccc;cursor: pointer" target="_blank">
                                                {{$sala->professor->students->count()}}
                                            </a>
                                            {{$sala->professor->user->name}}
                                        @endif
                                    </td>
                                    <td class="text-truncate text-center">
                                        <a data-bs-toggle="modal"
                                           data-bs-target="#{{ 'modal_Edit_Sala'. $sala->id }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a data-bs-toggle="modal"
                                           data-bs-target="#{{ 'modal_Delete_Sala' . $sala->id }}"
                                           class="btn btn-sm btn-danger w-100">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                @include('dashboard.salas.includes.delete', ['sala' => $sala])
                                @include('dashboard.salas.includes.edit', ['sala' => $sala])
                            @empty
                                <td class="text-danger">Nenhum registro encontrado!</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection