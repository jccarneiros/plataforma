@extends('layouts.master')

@section('content')
    @can('areaconhecimentos.edit')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.areaconhecimentos.index')}}">
                                    Áreas de Conhecimento
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$item->name}} |
                                Usuários: {{$item->areaConhecimentoUsers->count()}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <div class="row">
                                <form action="{{route('dashboard.areaconhecimentos.store.users', $item->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="area_conhecimento_id" value="{{$item->id}}">
                                    <select name="user_id" class="form-select form-select-sm" multiple size="10" onclick="this.form.submit()">
                                        @foreach($users as  $user)
                                            <option value="{{$user->id}}" class="border border-1 mt-2 p-2 text-bg-light">
                                                {{$user->role}} => {{$user->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                            <div class="fixTableHead">
                                <table class="table table-sm table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th style="width: 3rem">Status</th>
                                        <th style="width: 2rem">Excluír</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($item->areaConhecimentoUsers as $areaConhecimentoUser)
                                        <tr>
                                            <td class="text-truncate">{{$areaConhecimentoUser->user->name}}</td>
                                            <td class="text-truncate">{{$areaConhecimentoUser->user->email}}</td>
                                            <td class="text-truncate">{{$areaConhecimentoUser->user->role}}</td>
                                            <td class="text-truncate text-center">
                                                <form action="{{route('dashboard.areaconhecimentos.delete.user', $areaConhecimentoUser->id)}}"
                                                      method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-user-xmark"></i></button>
                                                </form>
                                            </td>
                                        </tr>
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
        </div>
    @endcan
@endsection
@push('styles')
    <style>
        @media (max-width: 768px) {
            .hidden-mobile {
                display: none;
            }
        }
    </style>
    <style>
        /* Fixed Headers */
        .fixTableHead {
            overflow-y: auto;
            height: 26rem;
        }

        .fixTableHead thead th {
            position: sticky;
            top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px 0;
        }

        th {
            background: #ABDD93;
        }

        tr, col {
            transition: all .3s;
        }

        tbody tr:hover {
            background-color: rgba(0, 140, 203, .2);
        }

        col.hover {
            background-color: rgba(0, 140, 203, .2);
        }
    </style>
@endpush


