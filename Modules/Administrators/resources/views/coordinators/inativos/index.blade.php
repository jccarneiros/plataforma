@extends('administrators::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrators')}}">Painel</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administrators.coordinators.index')}}">Coordenadores</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Coordenadores bloqueados</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="border border-1 p-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <a href="{{route('administrators')}}" class="btn btn-sm btn-primary w-100">
                                    Painel
                                </a>
                            </div>
                        </div>
                        <div class="border border-1 p-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <a href="{{route('administrators.coordinators.index')}}"
                                   class="btn btn-sm btn-secondary w-100">
                                    Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                        <div class="border border-1 p-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table id="tableIndex" class="table table-hover table-sm table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-truncate">ID</th>
                                            <th class="text-truncate">Nome</th>
                                            <th class="text-truncate">Email</th>
                                            <th class="text-truncate" style="width: 5rem">Data</th>
                                            <th class="text-center" style="width: 5rem">Desbloquear</th>
                                            <th class="text-center" style="width: 5rem">Excluir</th>
                                        </tr>
                                        </thead>
                                        @forelse($coordinators as $coordinator)
                                            <tbody>
                                            <tr>
                                                <td class="text-truncate">{{$coordinator->code}}</td>
                                                <td class="text-truncate">{{$coordinator->name}}</td>
                                                <td class="text-truncate">{{$coordinator->email}}</td>
                                                <td class="text-truncate">{{Carbon\Carbon::parse($coordinator->created_at)->format('d/m/Y')}}</td>
                                                <td class="text-truncate text-center">
                                                    @can('supervisions.restore')
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_Restore' . $coordinator->id }}"
                                                           class="btn btn-sm btn-warning w-100">Desbloquear
                                                        </a>
                                                    @endcan
                                                </td>
                                                <td class="text-center">
                                                    @can('supervisions.forceDelete')
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#{{ 'modal_ForceDelete'. $coordinator->id }}"
                                                           class="btn btn-sm btn-danger w-100">Excluir
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            </tbody>
                                            @include('administrators::coordinators.modals.restore', ['coordinator' => $coordinator])
                                            @include('administrators::coordinators.modals.force-delete', ['coordinator' => $coordinator])
                                        @empty

                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    @endcan--}}
@endsection
@push('scripts')

@endpush
