@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                        <li class="breadcrumb-item"><a href="{{route('painel.alunos.index')}}">Alunos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Turmas</li>
                    </ol>
                </nav>
            </div>
        </div>
        @foreach ($rooms as $room)
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <div class="card">
                    <div class="card-body border border-info-subtle">
                        <h6 class="card-subtitle text-center mb-2 text-white-50">{{ $room->name }}</h6>
                        <a href="{{route('painel.estudantes.listar-turma-entradas', $room->id)}}"
                           class="btn btn-sm btn-primary w-100" target="_blank">Listar entradas</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection