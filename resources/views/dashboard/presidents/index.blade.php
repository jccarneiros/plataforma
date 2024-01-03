@extends('layouts.master')

@section('content')
    @can('presidents.index')
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
                                        Total: {{$presidents->count()}}</li>
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
                        @can('presidents.create')
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    @include('dashboard.presidents.includes.create')
                                </div>
                            </div>
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    @can('presidents.edit')
                                        <th>Sala</th>
                                        <th>Status</th>
                                        <th>Limite</th>
                                    @endcan
                                    <th>Preisdent</th>
                                    <th>Nome do Clube</th>
                                    @can('clubes.index')
                                        <th style="width: 5rem">Associados</th>
                                    @endcan
                                    @can('presidents.delete')
                                        <th style="width: 3rem">Excluir</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($presidents as $president)
                                    <tr>
                                        @can('presidents.edit')
                                            <td>
                                                <form action="{{route('dashboard.presidents.updateSala', $president->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$president->id}}">
                                                    <select name="sala_id" class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                        <option value="{{$president->sala_id}}">{{$president->sala->name}}</option>
                                                        @foreach($salas as $sala)
                                                            <option value="{{$sala->id}}" {{$president->sala_id == $sala->id ? 'selected' : ''}}>{{$sala->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('dashboard.salas.updateStatusPresident', $president->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$president->id}}">
                                                    <select name="status_clube" class="form-select form-control-sm"
                                                            onchange="this.form.submit()"
                                                            style="font-size: 90% !important;">
                                                        @if($president->status_clube !== 1)
                                                            <option value="{{$president->status_clube}}">Inativo</option>
                                                            <option value="1">Ativar</option>
                                                        @else
                                                            <option value="{{$president->status_clube}}">Ativo</option>
                                                            <option value="0">Inativar</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('dashboard.salas.updateLimitPresident', $president->id)}}"
                                                      method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="id" value="{{$president->id}}">
                                                    <select name="limit_clube_students"
                                                            class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                        <option value="0">Limite</option>
                                                        @foreach(range(1, 30) as $number)
                                                            <option value="{{$number}}" {{$president->limit_clube_students == $number ? 'selected' : ''}}>{{$number}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                        @endcan
                                        <td>
                                            {{$president->user->name}}
                                        </td>
                                        <td>
                                            {{$president->name_clube}}
                                        </td>
                                        @can('clubes.index')
                                            <td>
                                                <a href="{{route('dashboard.presidents.clubes', $president->id)}}"
                                                   style="text-decoration: none;color: #cccccc;cursor: pointer"
                                                   class="btn btn-sm btn-secondary w-100">
                                                    {{$president->students->count()}}
                                                </a>
                                            </td>
                                        @endcan
                                        @can('presidents.delete')
                                            <td class="text-center">
                                                <a data-bs-toggle="modal"
                                                   data-bs-target="#{{ 'modal_Delete_President' . $president->id }}"
                                                   class="btn btn-sm btn-danger w-100">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                    @can('presidents.delete')
                                        @include('dashboard.presidents.includes.delete', ['president' => $president])
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