@extends('layouts.master')

@section('content')
    @can('series.index')
        <div class="container-fluid">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        @can('series.create')
                            @include('dashboard.series.includes.create', ['tipoEnsinos' => $tipoEnsinos])
                        @endcan
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 12rem">Tipo de Ensino</th>
                                            <th>Série</th>
                                            <th style="width: 5rem">Tipo</th>
                                            @can('rooms.index')
                                                <th style="width: 5rem">Gerenciar</th>
                                            @endcan
                                            @can('series.edit')
                                                <th style="width: 3rem">Editar</th>
                                            @endcan
                                            @can('series.delete')
                                                <th style="width: 3rem">Excluir</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($data as $item)
                                            <tr>
                                                <td class="text-truncate">{{$item->tipoEnsino->name}}</td>
                                                <td class="text-truncate">{{$item->name}}</td>
                                                <td class="text-truncate">{{$item->type}}</td>
                                                @can('rooms.index')
                                                    <td class="text-truncate text-center">
                                                        <a href="{{route('dashboard.rooms.index', [$item->tipoEnsino->id,$item->id])}}"
                                                           class="btn btn-sm btn-info">
                                                            Turmas
                                                        </a>
                                                    </td>
                                                @endcan
                                                @can('series.edit')
                                                    <td class="text-truncate text-center text-bg-blue-light">
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Edit_Serie' . $item->id }}"
                                                           class="btn btn-sm btn-warning">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                @endcan
                                                @can('series.delete')
                                                    <td class="text-center text-bg-blue-light">
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Delete_Serie' . $item->id }}"
                                                           class="btn btn-sm btn-danger w-100">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                @endcan
                                            </tr>
                                            @can('series.delete')
                                                @include('dashboard.series.includes.delete', ['item' => $item])
                                            @endcan
                                            @can('series.edit')
                                                @include('dashboard.series.includes.edit', ['item' => $item])
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
