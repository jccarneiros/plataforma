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
                                    aria-current="page">Turma / {{auth()->user()->name}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10rem">Tipo de Ensino</th>
                                <th style="width: 5rem">Série</th>
                                <th>Turma</th>
                                <th style="width: 5rem">Tipo</th>
                                <th style="width: 5rem">Conselho</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rooms as $room)
                                <tr>
                                    <td class="text-truncate">{{$room->tipoEnsino->name}}</td>
                                    <td class="text-truncate">{{$room->serie->name}}</td>
                                    <td class="text-truncate">{{$room->name}}</td>
                                    <td class="text-truncate">{{$room->type}}</td>
                                    <td class="text-truncate text-center">
                                        <a href="{{route('dashboard.students.conselho.teacher.room', $room->id)}}"
                                           class="btn btn-sm btn-info">
                                            {{$room->name}}
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
@endsection

