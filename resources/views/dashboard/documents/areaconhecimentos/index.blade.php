@extends('layouts.master')

@section('content')
    @can('area_conhecimentos.index')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Área de Conhecimentos</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            @include('dashboard.documents.areaconhecimentos.includes.create')
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col" style="width: 2rem !important;">Disciplinas</th>
                                        <th scope="col" style="width: 2rem !important;">
                                            Usuários
                                        </th>
                                        <th scope="col" style="width: 2rem !important;">
                                            Documentos
                                        </th>
                                        <th style="width: 3rem">Editar</th>
                                        <th scope="col" style="width: 2rem !important;" class="text-center">
                                            Excluír
                                        </th>
                                    </tr>
                                    </thead>
                                    @foreach($data as $item)
                                        <tbody>
                                        <tr>
                                            <td class="text-truncate">{{$item->name}}</td>
                                            <td class="text-truncate">
                                                @can('disciplinas.index')
                                                    <a href="{{route('dashboard.disciplinas.index', $item->id)}}"
                                                       class="btn btn-sm btn-success">
                                                        Disciplinas
                                                    </a>
                                                @endcan
                                            </td>
                                            <td class="text-truncate text-center">
                                                @can('areaconhecimentos.edit')
                                                    <a href="{{route('dashboard.areaconhecimentos.users', $item->id)}}"
                                                       class="btn btn-sm btn-info">
                                                        Usuários <span class="badge bg-secondary"
                                                                       style="font-size: 100%!important;">{{$item->areaConhecimentoUsers->count()}}</span>
                                                    </a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('areaconhecimentos.edit')
                                                    <a href="{{route('dashboard.document-types.index', $item->id)}}"
                                                       class="btn btn-sm  btn-secondary">
                                                        Documentos
                                                    </a>
                                                @endcan
                                            </td>
                                            <td class="text-truncate text-center">
                                                @can('areaconhecimentos.edit')
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#{{ 'modal_Edit_AreaConhecimento' . $item->id }}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                            <td class="text-center">
                                                @can('areaconhecimentos.delete')
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#{{ 'modal_Delete_AreaConhecimento' . $item->id }}"
                                                       class="btn btn-sm btn-danger w-100">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                        </tbody>
                                        @can('areaconhecimentos.edit')
                                            @include('dashboard.documents.areaconhecimentos.modals.edit', ['item' => $item])
                                        @endcan
                                        @can('areaconhecimentos.delete')
                                            @include('dashboard.documents.areaconhecimentos.modals.delete', ['item' => $item])
                                        @endcan
                                    @endforeach
                                </table>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="d-flex justify-content-end">
                                                {{$data->links()}}
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