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
                                <a href="{{route('dashboard.areaconhecimentos.index', $areaconhecimento->id)}}">
                                    Área de Conhecimentos
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.document-types.index', $documenttype->id)}}">
                                    Tipos de Documentos
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.document-periods.index', [$areaconhecimento->id, $documenttype->id])}}">
                                    Períodos
                                </a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{route('dashboard.document-periods.update', $item->id)}}" method="POST">
                            @csrf @method('PUT')
                            <div class="row mb-3">
                                <input type="hidden" name="area_conhecimento_id" value="{{$areaconhecimento->id}}">
                                <input type="hidden" name="document_type_id" value="{{$documenttype->id}}">
                                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                    <label for="name" class="text-white-50">Área de Conhecimento</label>
                                    <input type="text" value="{{$areaconhecimento->name}}" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                    <label for="name" class="text-white-50">Tipo de Documento</label>
                                    <input type="text" value="{{$documenttype->name}}" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                    <label for="name" class="text-white-50">Periodicidade</label>
                                    <input type="text" name="periodicidade" value="{{$documenttype->periodicidade}}"
                                           class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                    <label for="name" class="text-white-50">Referência</label>
                                    <select name="referencia" class="form-select form-select-sm @error('referencia') is-invalid @enderror">
                                        @switch($documenttype->periodicidade)
                                            @case($documenttype->periodicidade === "Anual")
                                                <option value="">Selecione a Referência</option>
                                                @foreach(array('2023', '2024', '2025', '2026') as $rowYear)
                                                    <option value="{{$rowYear}}" {{$item->referencia == $rowYear ? 'selected' : ''}}>{{$rowYear}}</option>
                                                @endforeach
                                                @break
                                            @case($documenttype->periodicidade === "Semestral")
                                                <option value="">Selecione a Referência</option>
                                                @foreach(array('1º semestre', '2º semestre') as $rowSemestre)
                                                    <option value="{{$rowSemestre}}" {{$item->referencia == $rowSemestre ? 'selected' : ''}}>{{$rowSemestre}}</option>
                                                @endforeach
                                                @break
                                            @case($documenttype->periodicidade === "Bimestral")
                                                <option value="">Selecione a Referência</option>
                                                @foreach(array('1º bimestre', '2º bimestre', '3º bimestre', '4º bimestre') as $rowBimestre)
                                                    <option value="{{$rowBimestre}}" {{$item->referencia == $rowBimestre ? 'selected' : ''}}>{{$rowBimestre}}</option>
                                                @endforeach
                                                @break
                                            @case($documenttype->periodicidade === "Mensal")
                                                <option value="">Selecione a Referência</option>
                                                @foreach(array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro') as $rowMonth)
                                                    <option value="{{$rowMonth}}" {{$item->referencia == $rowMonth ? 'selected' : ''}}>{{$rowMonth}}</option>
                                                @endforeach
                                                @break
                                            @case($documenttype->periodicidade === "Quinzenal")
                                                <option value="">Selecione a Referência</option>
                                                @foreach(array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro') as $rowQuinzena)
                                                    <option value="{{$rowQuinzena}}" {{$item->referencia == $rowQuinzena ? 'selected' : ''}}>{{$rowQuinzena}}</option>
                                                @endforeach
                                                @break
                                        @endswitch
                                    </select>
                                    @error('referencia')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <label for="title" class="text-white-50">Data Inicial</label>
                                    <input type="date" name="date_initial"
                                           value="{{$item->date_initial, old('date_initial')}}"
                                           class="form-control form-control-sm @error('date_initial') is-invalid @enderror">
                                    @error('date_initial')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <label for="title" class="text-white-50">Data Final</label>
                                    <input type="date" name="date_final"
                                           value="{{$item->date_final, old('date_final')}}"
                                           class="form-control form-control-sm @error('date_final') is-invalid @enderror">
                                    @error('date_final')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <label for="title" class="text-white-50">Limite para entrega</label>
                                    <input type="date" name="date_limit"
                                           value="{{$item->date_limit, old('date_limit')}}"
                                           class="form-control form-control-sm @error('date_limit') is-invalid @enderror">
                                    @error('date_limit')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <label for="title" class="text-white-50">Nome para o documento</label>
                                    <input type="text" value="{{$item->name}}" class="form-control form-control-sm" readonly>
                                    <input type="hidden" name="name" value="{{$documenttype->name}}"
                                           class="form-control form-control-sm @error('name') is-invalid @enderror">
                                    @error('name') <span class="text-danger">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row border border-1 pt-2 pb-3">
                                <h5 class="text-white">Dados Opcionais</h5>
                                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th>Solicitar Tipo de Ensino?</th>
                                            <th>Solicitar Série?</th>
                                            <th>Solicitar Disciplina?</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input name="tipo_ensino" class="form-check-input" type="radio"
                                                           id="tipo_ensino1" value="1" {{$item->tipo_ensino != 0 ? 'checked': ''}}>
                                                    <label class="form-check-label" for="tipo_ensino1">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="tipo_ensino" class="form-check-input" type="radio"
                                                           id="tipo_ensino2" value="0" {{$item->tipo_ensino != 1 ? 'checked': ''}}>
                                                    <label class="form-check-label" for="tipo_ensino2">Não</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input name="serie" class="form-check-input" type="radio"
                                                           id="serie1" value="1" {{$item->serie != 0 ? 'checked': ''}}>
                                                    <label class="form-check-label" for="serie1">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="serie" class="form-check-input" type="radio"
                                                           id="serie2" value="0" {{$item->serie != 1 ? 'checked': ''}}>
                                                    <label class="form-check-label" for="serie2">Não</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input name="disciplina" class="form-check-input" type="radio"
                                                           id="disciplina1" value="1" {{$item->disciplina != 0 ? 'checked': ''}}>
                                                    <label class="form-check-label" for="disciplina1">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="disciplina" class="form-check-input" type="radio"
                                                           id="disciplina2" value="0" {{$item->disciplina != 1 ? 'checked': ''}}>
                                                    <label class="form-check-label" for="disciplina2">Não</label>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                    <label for="title" class="text-white-50">Salvar</label>
                                    <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection