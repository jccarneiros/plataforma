@extends('layouts.master')

@section('content')
    @can('documents.index')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">
                                    Painel
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.areaconhecimentos.index')}}">
                                   Área de Conhecimentos
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$areaconhecimento->name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    @can('documents.create')
                        @include('dashboard.documents.document-types.includes.create')
                    @endcan
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Tipos de Documentos</th>
                                <th>Periodicidade</th>
                                {{--                                                <th style="width: 3rem">Documentos</th>--}}
                                <th style="width: 3rem">Períodos</th>
                                <th style="width: 3rem">Recebidos</th>
                                <th style="width: 3rem">Editar</th>
                                <th style="width: 3rem">Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="text-truncate">{{$item->name}}</td>
                                    <td class="text-truncate">{{$item->periodicidade}}</td>
                                    {{--                                                    <td class="text-truncate text-center">{{$item->documentPeriods->count()}}</td>--}}
                                    <td class="text-truncate text-center">
                                        @can('documents.edit')
                                            <a href="{{route('dashboard.document-periods.index', [$areaconhecimento, $item->id])}}"
                                               class="btn btn-sm btn-info">
                                                gerenciar
                                                <span class="badge bg-secondary"
                                                      style="font-size: 100%!important;">{{$item->documentPeriods->count()}}</span>
                                            </a>
                                        @endcan
                                    </td>
                                    <td class="text-truncate text-center">
                                        @can('documents.index')
                                            <a href="{{route('dashboard.document-recebidos.index', [$areaconhecimento, $item->id])}}"
                                               class="btn btn-sm btn-secondary">
                                                Recebidos
                                                <span class="badge bg-secondary"
                                                      style="font-size: 100%!important;">{{$item->documentPeriods->count()}}</span>
                                            </a>
                                        @endcan
                                    </td>

                                    <td class="text-truncate text-center">
                                        @can('documents.edit')
                                            <a data-bs-toggle="modal"
                                               data-bs-target="#{{ 'modal_Edit_DocumentType' . $item->id }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan
                                    </td>
                                    <td class="text-center">
                                        @can('documents.delete')
                                            <a data-bs-toggle="modal"
                                               data-bs-target="#{{ 'modal_Delete_DocumentType' . $item->id }}"
                                               class="btn btn-sm btn-danger w-100">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                                @can('documents.edit')
                                    @include('dashboard.documents.document-types.modals.edit', ['item' => $item])
                                @endcan
                                @can('documents.delete')
                                    @include('dashboard.documents.document-types.modals.delete', ['item' => $item])
                                @endcan
                            @empty
                                <td colspan="5" class="text-danger">Nenhum registro encontrado!</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection