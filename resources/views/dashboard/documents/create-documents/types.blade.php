@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.documents.index')}}">{{$documenttype->areaConhecimento->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$documenttype->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="sticky">
                            <tr>
                                <th>Tipos de Documentos</th>
                                <th style="width: 5rem">Periodicidade</th>
                                <th style="width: 5rem">Referência</th>
                                <th style="width: 3rem">Início</th>
                                <th style="width: 3rem">Término</th>
                                <th style="width: 3rem">Limite</th>
                                <th style="width: 3rem">Editar</th>
                                <th style="width: 3rem">Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($documentPeriods as $documentPeriod)
                                <tr>
                                    <td class="text-truncate">{{$documentPeriod->documentType->name}}</td>
                                    <td class="text-truncate">{{$documentPeriod->periodicidade}}</td>
                                    <td class="text-truncate">{{$documentPeriod->referencia}}</td>
                                    <td class="text-truncate">
                                        {{\Carbon\Carbon::parse($documentPeriod->date_initial)->format('d/m/Y')}}
                                    </td>
                                    <td class="text-truncate">
                                        {{\Carbon\Carbon::parse($documentPeriod->date_final)->format('d/m/Y')}}
                                    </td>
                                    <td class="text-truncate">
                                        {{\Carbon\Carbon::parse($documentPeriod->date_final)->format('d/m/Y')}}
                                    </td>
                                    <td class="text-truncate text-center">
                                        <a href="{{route('dashboard.documents.documentPeriods', $documentPeriod->id)}}"
                                           class="btn btn-sm btn-info">
                                            Gerenciar
                                        </a>
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
                                {{--                                    @can('documents.edit')--}}
                                {{--                                        @include('dashboard.documents.document-types.modals.edit', ['item' => $item])--}}
                                {{--                                    @endcan--}}
                                {{--                                    @can('documents.delete')--}}
                                {{--                                        @include('dashboard.documents.document-types.modals.delete', ['item' => $item])--}}
                                {{--                                    @endcan--}}
                            @empty
                                <td colspan="5" class="text-danger">Nenhum registro encontrado!</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection