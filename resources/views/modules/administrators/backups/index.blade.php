@extends('administrators::layouts.master')

@section('content')
    @can('backups.index')
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    @can('backups.create')
                        <a id="send" href="{{route('administrators.backups.create')}}">
                            <button class="btn btn-sm btn-success w-100">
                                Criar backup
                            </button>
                        </a>
                    @endcan
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    {{--                    @can('backups.delete')--}}
                    {{--                        <a href="{{route('administrators.backups.clean')}}">--}}
                    {{--                            <button class="btn btn-sm btn-danger w-100">--}}
                    {{--                                Excluir backups--}}
                    {{--                            </button>--}}
                    {{--                        </a>--}}
                    {{--                    @endcan--}}
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <a href="{{route('administrators')}}">
                        <button class="btn btn-sm btn-primary w-100">
                            Painel
                        </button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <table class="table table-hover table-sm table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Data do backup</th>
                                @can('backups.download')
                                    <th scope="col" style="width: 5rem">Baixar</th>
                                @endcan
                                @can('backups.delete')
                                    <th scope="col" style="width: 5rem">Excluir</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>

                            @for($i=0;$i < count($arrayShipping);$i++)
                                <tr>
                                    <td class="sorting_1">
                                        <div>
                                            {{dateBackup($arrayShipping[$i])}}
                                        </div>
                                    </td>
                                    @can('backups.download')
                                        <td class="text-center">
                                            <a href="{{ route('administrators.backups.download', $arrayShipping[$i]['filename'])  }}"
                                               target="_blank">
                                                <button class="btn btn-sm btn-info">Baixar</button>
                                            </a>
                                        </td>
                                    @endcan
                                    @can('backups.delete')
                                        <td>
                                            <a href="{{route('administrators.backups.clean', $arrayShipping[$i]['filename'])}}">
                                                <button class="btn btn-sm btn-danger w-100">
                                                    Excluir
                                                </button>
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
