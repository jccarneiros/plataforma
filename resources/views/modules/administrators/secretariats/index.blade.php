@extends('administrators::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('administrators')}}">Painel</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Secretaria</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
                        @include('administrators::secretariats.includes.import-secretariat')
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <a href="{{route('administrators.secretariats.allTrashed')}}"
                               class="btn btn-sm btn-info w-100">Bloqueados</a>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <a href="{{route('administrators')}}" class="btn btn-sm btn-primary w-100">
                                Painel
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-3">
                        @include('administrators::secretariats.create')
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">E-mail</th>
                                            @can('supervisions.edit')
                                                <th scope="col" style="width: 10rem !important;">Função</th>
                                                <th style="width: 8rem">Status</th>
                                                <th style="width: 3rem">Editar</th>
                                            @endcan
                                            @can('supervisions.delete')
                                                <th style="width: 3rem">Bloquear</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($secretariats as $secretariat)
                                            <tr>
                                                <td class="text-truncate">{{$secretariat->name}}</td>
                                                <td class="text-truncate">{{$secretariat->email}}</td>
                                                <td>
                                                    @include('administrators::secretariats.includes.update-role')
                                                </td>
                                                <td>
                                                    @include('administrators::secretariats.includes.update-active')
                                                </td>
                                                <td class="text-truncate text-center">
                                                    <a href="{{route('administrators.secretariats.edit', $secretariat->id)}}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#{{ 'modal_Delete' . $secretariat->id }}"
                                                       class="btn btn-sm btn-danger w-100">Bloquear
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('administrators::secretariats.modals.delete', ['secretariat' => $secretariat])
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
    </div>
@endsection