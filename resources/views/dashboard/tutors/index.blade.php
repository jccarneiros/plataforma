@extends('layouts.master')

@section('content')
    @can('tutors.index')
        <div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-uppercase">
                        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Gerenciar Tutores |
                                        Total: {{$tutores->count()}}</li>
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
                        @can('tutors.create')
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    @include('dashboard.tutors.includes.create')
                                </div>
                            </div>
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    @can('tutors.edit')
                                        <th>Sala</th>
                                        <th>Status</th>
                                        <th>Limite</th>
                                    @endcan
                                    <th>Tutor</th>
                                    @can('tutorados.index')
                                        <th style="width: 5rem">Tutorados</th>
                                    @endcan
                                    @can('tutors.delete')
                                        <th style="width: 3rem">Excluir</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($tutores as $tutor)
                                    <tr>
                                        @can('tutors.edit')
                                            <td>
                                                <form action="{{route('dashboard.tutors.updateSala', $tutor->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$tutor->id}}">
                                                    <select name="sala_id" class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                        <option value="{{$tutor->sala_id}}">{{$tutor->sala->name}}</option>
                                                        @foreach($salas as $sala)
                                                            <option value="{{$sala->id}}" {{$tutor->sala_id == $sala->id ? 'selected' : ''}}>{{$sala->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('dashboard.salas.updateStatusTutor', $tutor->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$tutor->id}}">
                                                    <select name="status_tutoria" class="form-select form-control-sm"
                                                            onchange="this.form.submit()">
                                                        @if($tutor->status_tutoria !== 1)
                                                            <option value="{{$tutor->status_tutoria}}">Inativo</option>
                                                            <option value="1">Ativar</option>
                                                        @else
                                                            <option value="{{$tutor->status_tutoria}}">Ativo</option>
                                                            <option value="0">Inativar</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('dashboard.salas.updateLimitTutor', $tutor->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$tutor->id}}">
                                                    <select name="limit_tutoria_students"
                                                            class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                        <option value="0">Limite</option>
                                                        @foreach(range(1, 30) as $number)
                                                            <option value="{{$number}}" {{$tutor->limit_tutoria_students == $number ? 'selected' : ''}}>{{$number}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                        @endcan
                                        <td>
                                            {{$tutor->user->name}}
                                        </td>
                                        @can('tutorados.index')
                                            <td>
                                                <a href="{{route('dashboard.tutors.tutorias', $tutor->id)}}"
                                                   style="text-decoration: none;color: #cccccc;cursor: pointer"
                                                   class="btn btn-sm btn-secondary w-100">
                                                    {{$tutor->students->count()}}
                                                </a>
                                            </td>
                                        @endcan
                                        @can('tutors.delete')
                                            <td class="text-center">
                                                <a data-bs-toggle="modal"
                                                   data-bs-target="#{{ 'modal_Delete_Tutor' . $tutor->id }}"
                                                   class="btn btn-sm btn-danger w-100">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                    @can('tutors.delete')
                                        @include('dashboard.tutors.includes.delete', ['tutor' => $tutor])
                                    @endcan
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
    @endcan
@endsection