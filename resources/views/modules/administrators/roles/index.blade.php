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
                            <li class="breadcrumb-item active" aria-current="page">Grupos</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('administrators::roles.includes.create-roles')
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Nome do grupo</th>
                                    <th scope="col" style="width: 2rem !important;" class="text-center">Editar</th>
                                    <th scope="col" style="width: 2rem !important;" class="text-center">Excluír</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td class="text-truncate">{{$role->name}}</td>
                                        <td class="text-center">
                                            @can('roles.edit')
                                                <a href="{{route('administrators.roles.edit', $role->id)}}"
                                                   class="btn btn-sm btn-warning">
                                                    Editar
                                                </a>
                                            @endcan
                                        </td>
                                        <td class="text-center">
                                            @can('roles.delete')
                                                <a data-bs-toggle="modal"
                                                   data-bs-target="#{{ 'modal_Delete_Role' . $role->id }}"
                                                   class="btn btn-sm btn-danger">
                                                    Excluir
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @include('administrators::roles.includes.delete', ['role' => $role])
                                @empty


                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
