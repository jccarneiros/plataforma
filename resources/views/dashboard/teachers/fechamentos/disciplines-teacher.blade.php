@extends('layouts.master')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                                </li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">Disciplinas / {{auth()->user()->name}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 12rem">Tipos de Ensino</th>
                                        <th style="width: 3rem">Série</th>
                                        <th style="width: 3rem">Turma</th>
                                        <th>Disciplinas</th>
                                        <th class="text-center" style="width: 3rem">1ºB</th>
                                        <th class="text-center" style="width: 3rem">2ºB</th>
                                        <th class="text-center" style="width: 3rem">3ºB</th>
                                        <th class="text-center" style="width: 3rem">4ºB</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($disciplines as $item)
                                        <tr>
                                            <td class="text-truncate">{{$item->tipoEnsino->name}}</td>
                                            <td class="text-truncate">{{$item->serie->name}}</td>
                                            <td class="text-truncate">{{$item->room->name}}</td>
                                            <td class="text-truncate">
{{--                                                Lançar nota--}}
                                                <a href="{{route('dashboard.disciplines.teachers.fechamentos', [$item->room->code,$item->id])}}"
                                                   class="btn btn-sm btn-info">
                                                    {{$item->room->name}} | {{$item->name}}
                                                </a>
                                            </td>
                                            <td class="text-truncate text-center">
                                                <input type="hidden" name="room_id_export" value="{{$item->room->id}}">
                                                <a href="{{route('dashboard.disciplines.teachers.students.export', [$item->room->id,$item->id])}}"
                                                   class="btn btn-sm btn-outline-info">
                                                    Baixar Lista
                                                </a>
                                            </td>
                                            <td class="text-truncate text-center">
                                                <input type="hidden" name="room_id_export" value="{{$item->room->id}}">
                                                <a href="{{route('dashboard.disciplines.teachers.students.export', [$item->room->id,$item->id])}}"
                                                   class="btn btn-sm btn-outline-info">
                                                    Baixar Lista
                                                </a>
                                            </td>
                                            <td class="text-truncate text-center">
                                                <input type="hidden" name="room_id_export" value="{{$item->room->id}}">
                                                <a href="{{route('dashboard.disciplines.teachers.students.export', [$item->room->id,$item->id])}}"
                                                   class="btn btn-sm btn-outline-info">
                                                    Baixar Lista
                                                </a>
                                            </td>
                                            <td class="text-truncate text-center">
                                                <input type="hidden" name="room_id_export" value="{{$item->room->id}}">
                                                <a href="{{route('dashboard.disciplines.teachers.students.export', [$item->room->id,$item->id])}}"
                                                   class="btn btn-sm btn-outline-info">
                                                    Baixar Lista
                                                </a>
                                            </td>
                                        </tr>
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
@endsection