@extends('layouts.master')

@section('content')
    @can('rooms.index')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @can('rooms.create')
                            @include('dashboard.rooms.includes.create',['tipoEnsino' => $tipoEnsino, 'serie' => $serie])
                        @endcan
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 10rem">Tipo de Ensino</th>
                                            <th style="width: 5rem">Série</th>
                                            <th>Turma</th>
                                            <th style="width: 5rem">Tipo</th>
                                            @can('students.index')
                                                <th style="width: 5rem">Gerenciar</th>
                                            @endcan
                                            @can('students.index')
                                                <th style="width: 5rem">Disciplinas</th>
                                            @endcan
                                            @can('rooms.edit')
                                                <th style="width: 3rem">Editar</th>
                                            @endcan
                                            @can('rooms.delete')
                                                <th style="width: 3rem">Excluir</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($data->sortBy('name') as $item)
                                            <tr>
                                                <td class="text-truncate">{{$item->tipoEnsino->name}}</td>
                                                <td class="text-truncate">{{$item->serie->name}}</td>
                                                <td class="text-truncate">{{$item->name}}</td>
                                                <td class="text-truncate">{{$item->type}}</td>
                                                @can('students.index')
                                                    <td class="text-truncate text-center">
                                                        <a href="{{route('dashboard.rooms.students', [$tipoEnsino->id, $serie->id,$item->id])}}"
                                                           class="btn btn-sm btn-info">
                                                            Alunos [{{$item->students->count()}}]
                                                        </a>
                                                    </td>
                                                @endcan
                                                @can('students.index')
                                                    <td class="text-truncate text-center">
                                                        <a href="{{route('dashboard.disciplines.index', [$tipoEnsino->id, $serie->id,$item->id])}}"
                                                           class="btn btn-sm btn-info">
                                                            Disciplinas
                                                        </a>
                                                    </td>
                                                @endcan
                                                @can('rooms.edit')
                                                    <td class="text-truncate text-center">
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Edit_Room' . $item->id }}"
                                                           class="btn btn-sm btn-warning">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                @endcan
                                                @can('rooms.delete')
                                                    <td class="text-center">
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Delete_Room' . $item->id }}"
                                                           class="btn btn-sm btn-danger w-100">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                @endcan
                                            </tr>
                                            @can('rooms.delete')
                                                @include('dashboard.rooms.includes.delete', ['item' => $item])
                                            @endcan
                                            @can('rooms.edit')
                                                @include('dashboard.rooms.includes.edit', ['item' => $item])
                                            @endcan
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
