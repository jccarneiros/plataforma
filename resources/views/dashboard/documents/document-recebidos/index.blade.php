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
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.document-types.index', $areaconhecimento->id)}}">
                                    Tipos de Documentos
                                </a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">{{$documenttype->name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <input type="text" name="area_conhecimento" value="{{$areaconhecimento->name}}" class="form-control form-control-sm"
                                   readonly>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <input type="text" name="area_conhecimento" value="{{$documenttype->name}}" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <form action="{{route('dashboard.document-recebidos.filterDocumentRecebidosUsuarios', [$areaconhecimento->id,$documenttype->id])}}"
                                  method="GET">
                                <select name="user" id="" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Selecione um Professor</option>
                                    @foreach($areaConhecimentoUsers as $areaConhecimentoUser)
                                        <option value="{{$areaConhecimentoUser->user->id}}">
                                            {{$areaConhecimentoUser->user->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($userDocuments))
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Professor</th>
                                    <th style="width: 8rem">Periodicidade</th>
                                    <th style="width: 8rem">Referência</th>
                                    <th style="width: 5rem">Início</th>
                                    <th style="width: 5rem">Término</th>
                                    <th style="width: 5rem">Limite</th>
                                    <th style="width: 5rem">Postado</th>
                                    <th style="width: 2rem">Dias</th>
                                </tr>
                                </thead>
                                @foreach($userDocuments as $userDocument)
                                    <tbody>
                                    <tr>
                                        <td>{{$userDocument->user->name}}</td>
                                        <td>{{$userDocument->periodicidade}}</td>
                                        <td>{{$userDocument->referencia}}</td>
                                        <td class="text-center">
                                            {{\Carbon\Carbon::parse($userDocument->date_initial)->format('d/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            {{\Carbon\Carbon::parse($userDocument->date_final)->format('d/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            {{\Carbon\Carbon::parse($userDocument->date_limit)->format('d/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            @if(intervaloEntreDatas($userDocument->date_limit,$userDocument->created_at) > 0)
                                                <span class="text-danger">{{\Carbon\Carbon::parse($userDocument->created_at)->format('d/m/Y')}}</span>
                                            @else
                                                <span class="text-success">{{\Carbon\Carbon::parse($userDocument->created_at)->format('d/m/Y')}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{intervaloEntreDatas($userDocument->date_limit,$userDocument->created_at)}}
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection