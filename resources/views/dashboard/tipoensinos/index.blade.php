@extends('layouts.master')

@section('content')
    @can('tipo_ensinos.index')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @can('tipo_ensinos.create')
                            @include('dashboard.tipoensinos.includes.create')
                        @endcan
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 12rem">Tipo de Ensino</th>
                                    <th scope="col">Séries</th>
                                    <th style="width: 5rem">Tipo</th>
                                    @can('tipo_ensinos.edit')
                                        <th style="width: 3rem">Editar</th>
                                    @endcan
                                    @can('tipo_ensinos.delete')
                                        <th style="width: 3rem">Excluir</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td class="text-truncate">{{$item->name}}</td>
                                        <td class="text-truncate">
                                            @foreach($item->series as $serie)
                                                {{$serie->name}} /
                                            @endforeach
                                        </td>
                                        <td class="text-truncate">{{$item->type}}</td>
                                        @can('tipo_ensinos.edit')
                                            <td class="text-truncate text-center">
                                                <a data-bs-toggle="modal"
                                                   data-bs-target="#{{ 'modal_Edit_TipoEnsino' . $item->id }}"
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        @endcan
                                        @can('tipo_ensinos.delete')
                                            <td class="text-center">
                                                <a data-bs-toggle="modal"
                                                   data-bs-target="#{{ 'modal_Delete_TipoEnsino' . $item->id }}"
                                                   class="btn btn-sm btn-danger w-100">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                    @can('tipo_ensinos.delete')
                                        @include('dashboard.tipoensinos.includes.delete', ['item' => $item])
                                    @endcan
                                    @can('tipo_ensinos.edit')
                                        @include('dashboard.tipoensinos.includes.edit', ['item' => $item])
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
    @endcan
@endsection
