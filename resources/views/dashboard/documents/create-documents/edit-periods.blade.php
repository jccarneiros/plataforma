@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.documents.index')}}">{{$documentUserPeriod->areaConhecimento->name}}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.documents.documentType', $documentUserPeriod->documentType->id)}}">{{$documentUserPeriod->documentType->name}}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.documents.documentPeriods', $documentUserPeriod->documentPeriod->id)}}">{{$documentUserPeriod->documentType->name}} Enviadas</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Editar: {{$documentUserPeriod->documentType->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{route('dashboard.documents.documentUpdate', $documentUserPeriod->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row mb-3">
                            <input type="hidden" name="area_conhecimento_id" value="{{$documentUserPeriod->areaConhecimento->id}}">
                            <input type="hidden" name="document_type_id" value="{{$documentUserPeriod->documentType->id}}">
                            <input type="hidden" name="document_period_id" value="{{$documentUserPeriod->documentPeriod->id}}">
                            <input type="hidden" name="id" value="{{$documentUserPeriod->id}}">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <label for="name" class="text-white-50">Área de Conhecimento</label>
                                <input type="text" value="{{$documentUserPeriod->areaConhecimento->name}}" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <label for="name" class="text-white-50">Tipo de Documento</label>
                                <input type="text" value="{{$documentUserPeriod->documentType->name}}" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <label for="name" class="text-white-50">Periodicidade</label>
                                <input type="text" name="periodicidade" value="{{$documentUserPeriod->periodicidade}}"
                                       class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <label for="name" class="text-white-50">Periodicidade</label>
                                <input type="text" name="referencia" value="{{$documentUserPeriod->referencia}}"
                                       class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <label for="title" class="text-white-50">Data Inicial</label>
                                <input type="date" name="date_initial"
                                       value="{{$documentUserPeriod->date_initial, old('date_initial')}}" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <label for="title" class="text-white-50">Data Final</label>
                                <input type="date" name="date_final"
                                       value="{{$documentUserPeriod->date_final, old('date_final')}}" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <label for="title" class="text-white-50">Limite para entrega</label>
                                <input type="date" name="date_limit"
                                       value="{{$documentUserPeriod->date_limit, old('date_limit')}}" class="form-control form-control-sm" readonly>
                            </div>
                            {{-- NOME DO ARQUIVO--}}
                            <input type="hidden" name="name" value="{{$documentUserPeriod->name}}" class="form-control form-control-sm">
                            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                <label for="title" class="text-white-50">Selecionar Arquivo</label>
                                <input type="file" id="field" name="file" class="form-control form-control-sm @error('file') is-invalid @enderror">
                                @error('file')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                <label for="title" class="text-white-50">Salvar</label>
                                <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                @if($documentUserPeriod->documentPeriod->tipo_ensino  != 0)
                                    <label for="title" class="text-white-50">Tipo de Ensino</label>
                                    <select name="tipo_ensino_id" class="form-select form-select-sm">
                                        <option value="">Selecione o Tipo de Ensino</option>
                                        @foreach($tipoensinos as $tipoensino)
                                            <option value="{{$tipoensino->id}}" {{$documentUserPeriod->tipo_ensino_id == $tipoensino->id ? 'selected' : '' }}>
                                                {{$tipoensino->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                @if($documentUserPeriod->documentPeriod->serie  != 0)
                                    <label for="title" class="text-white-50">Série</label>
                                    <select name="serie_id" class="form-select form-select-sm">
                                        <option value="">Selecione a Série</option>
                                        @foreach($series as $serie)
                                            <option value="{{$serie->id}}" {{$documentUserPeriod->serie_id == $serie->id ? 'selected' : '' }}>
                                                {{$serie->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                @if($documentUserPeriod->documentPeriod->disciplina  != 0)
                                    <label for="title" class="text-white-50">Disciplina</label>
                                    <select name="disciplina_id" class="form-select form-select-sm">
                                        <option value="">Selecione a Disciplina</option>
                                        @foreach($disciplinas as $disciplina)
                                            <option value="{{$disciplina->id}}" {{$documentUserPeriod->disciplina_id == $disciplina->id ? 'selected' : '' }}>
                                                {{$disciplina->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    {{--                        <table class="table table-sm table-bordered table-hover">--}}
                    {{--                            <thead class="sticky">--}}
                    {{--                            <tr>--}}
                    {{--                                <th>Tipos de Documentos</th>--}}
                    {{--                                <th style="width: 5rem">Periodicidade</th>--}}
                    {{--                                <th style="width: 5rem">Referência</th>--}}
                    {{--                                <th style="width: 3rem">Início</th>--}}
                    {{--                                <th style="width: 3rem">Término</th>--}}
                    {{--                                <th style="width: 3rem">Limite</th>--}}
                    {{--                                <th style="width: 3rem">Editar</th>--}}
                    {{--                                <th style="width: 3rem">Excluir</th>--}}
                    {{--                            </tr>--}}
                    {{--                            </thead>--}}
                    {{--                            <tbody>--}}
                    {{--                            @forelse ($documentPeriods as $documentPeriod)--}}
                    {{--                                <tr>--}}
                    {{--                                    <td class="text-truncate">{{$documentPeriod->documentType->name}}</td>--}}
                    {{--                                    <td class="text-truncate">{{$documentPeriod->periodicidade}}</td>--}}
                    {{--                                    <td class="text-truncate">{{$documentPeriod->referencia}}</td>--}}
                    {{--                                    <td class="text-truncate">--}}
                    {{--                                        {{\Carbon\Carbon::parse($documentPeriod->date_initial)->format('d/m/Y')}}--}}
                    {{--                                    </td>--}}
                    {{--                                    <td class="text-truncate">--}}
                    {{--                                        {{\Carbon\Carbon::parse($documentPeriod->date_final)->format('d/m/Y')}}--}}
                    {{--                                    </td>--}}
                    {{--                                    <td class="text-truncate">--}}
                    {{--                                        {{\Carbon\Carbon::parse($documentPeriod->date_final)->format('d/m/Y')}}--}}
                    {{--                                    </td>--}}
                    {{--                                    <td class="text-truncate text-center">--}}
                    {{--                                        <a href="{{route('dashboard.documents.documentPeriods', $documentPeriod->id)}}"--}}
                    {{--                                           class="btn btn-sm btn-info">--}}
                    {{--                                            Gerenciar--}}
                    {{--                                        </a>--}}
                    {{--                                    </td>--}}
                    {{--                                    <td class="text-center">--}}
                    {{--                                        @can('documents.delete')--}}
                    {{--                                            <a data-bs-toggle="modal"--}}
                    {{--                                               data-bs-target="#{{ 'modal_Delete_DocumentType' . $item->id }}"--}}
                    {{--                                               class="btn btn-sm btn-danger w-100">--}}
                    {{--                                                <i class="fa-solid fa-trash"></i>--}}
                    {{--                                            </a>--}}
                    {{--                                        @endcan--}}
                    {{--                                    </td>--}}
                    {{--                                </tr>--}}
                    {{--                                --}}{{--                                    @can('documents.edit')--}}
                    {{--                                --}}{{--                                        @include('dashboard.documents.document-types.modals.edit', ['item' => $item])--}}
                    {{--                                --}}{{--                                    @endcan--}}
                    {{--                                --}}{{--                                    @can('documents.delete')--}}
                    {{--                                --}}{{--                                        @include('dashboard.documents.document-types.modals.delete', ['item' => $item])--}}
                    {{--                                --}}{{--                                    @endcan--}}
                    {{--                            @empty--}}
                    {{--                                <td colspan="5" class="text-danger">Nenhum registro encontrado!</td>--}}
                    {{--                            @endforelse--}}
                    {{--                            </tbody>--}}
                    {{--                        </table>--}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection