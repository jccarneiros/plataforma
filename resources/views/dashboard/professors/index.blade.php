@extends('layouts.master')

@section('content')
    @can('professors.index')
        <div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-uppercase">
                        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Gerenciar Professores |
                                        Total: {{$professors->count()}}</li>
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
                        @can('professors.create')
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    @include('dashboard.professors.includes.create')
                                </div>
                            </div>
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    @can('professors.edit')
                                        <th>Sala</th>
                                        <th>Status</th>
                                        <th>Limite</th>
                                    @endcan
                                    <th>Professor</th>
                                    @can('eletivas.index')
                                        <th style="width: 5rem">Professorados</th>
                                    @endcan
                                    @can('professors.delete')
                                        <th style="width: 3rem">Excluir</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($professors as $professor)
                                    <tr>
                                        @can('professors.edit')
                                            <td>
                                                <form action="{{route('dashboard.professors.updateSala', $professor->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$professor->id}}">
                                                    <select name="sala_id" class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                        <option value="{{$professor->sala_id}}">{{$professor->sala->name}}</option>
                                                        @foreach($salas as $sala)
                                                            <option value="{{$sala->id}}" {{$professor->sala_id == $sala->id ? 'selected' : ''}}>{{$sala->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('dashboard.salas.updateStatusProfessor', $professor->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$professor->id}}">
                                                    <select name="status_eletiva" class="form-select form-control-sm"
                                                            onchange="this.form.submit()"
                                                            style="font-size: 90% !important;">
                                                        @if($professor->status_eletiva !== 1)
                                                            <option value="{{$professor->status_eletiva}}">Inativo</option>
                                                            <option value="1">Ativar</option>
                                                        @else
                                                            <option value="{{$professor->status_eletiva}}">Ativo</option>
                                                            <option value="0">Inativar</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('dashboard.salas.updateLimitProfessor', $professor->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$professor->id}}">
                                                    <select name="limit_eletiva_students"
                                                            class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                        <option value="0">Limite</option>
                                                        @foreach(range(1, 50) as $number)
                                                            <option value="{{$number}}" {{$professor->limit_eletiva_students == $number ? 'selected' : ''}}>{{$number}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                        @endcan
                                        <td>
                                            {{$professor->user->name}}
                                        </td>
                                        @can('eletivas.index')
                                            <td>
                                                <a href="{{route('dashboard.professors.eletivas', $professor->id)}}"
                                                   style="text-decoration: none;color: #cccccc;cursor: pointer"
                                                   class="btn btn-sm btn-secondary w-100">
                                                    {{$professor->students->count()}}
                                                </a>
                                            </td>
                                        @endcan
                                        @can('professors.delete')
                                            <td class="text-center">
                                                <a data-bs-toggle="modal"
                                                   data-bs-target="#{{ 'modal_Delete_Professor' . $professor->id }}"
                                                   class="btn btn-sm btn-danger w-100">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                    @can('professors.delete')
                                        @include('dashboard.professors.includes.delete', ['professor' => $professor])
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