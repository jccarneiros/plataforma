@extends('layouts.master')

@section('content')
    @can('users.onlyTrashed')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                            <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">Usuários</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Usuários bloqueados</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <form method="POST" action="{{route('dashboard.users.restoreUsers')}}">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                                            Desbloquear Registro
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            @can('users.restore')
                                                <button type="submit" class="btn btn-warning btn-sm w-100" data-confirm-delete="true"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Desbloquear Registros Selecionados">
                                                    Desbloquear
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <table id="tableIndex" class="table table-hover table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="10px" class="text-center">
                                            <label class="control control--checkbox">
                                                <input type="checkbox" id="restoreckAll"/>
                                                <span class="control__indicator restorechk"></span>
                                            </label>
                                        </th>
                                        <th scope="col">Perfil</th>
                                        <th class="text-truncate">Nome</th>
                                        <th class="text-truncate" style="width: 5rem">Bloqueado</th>
                                    </tr>
                                    </thead>
                                    @forelse($data as $item)
                                        <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <label class="control control--checkbox">
                                                    <input name="restore[]" value="{{$item->id}}" type="checkbox" class="restorechk"/>
                                                    <span class="control__indicator restorechk"></span>
                                                </label>
                                            </td>
                                            <td class="text-truncate">{{$item->role}}</td>
                                            <td class="text-truncate">{{$item->name}}</td>
                                            <td class="text-truncate">{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                                        </tr>
                                        </tbody>
                                    @empty

                                    @endforelse
                                </table>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <form method="POST" action="{{route('dashboard.users.forceDeleteUsers')}}">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                                            Excluir Registro
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            @can('users.forceDelete')
                                                <button type="submit" class="btn btn-danger btn-sm w-100" data-confirm-delete="true"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Excluir Registros Selecionados">
                                                    Excluir
                                                </button>
                                            @endcan
                                        </div>

                                    </div>
                                </div>
                                <table id="tableIndex" class="table table-hover table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="10px" class="text-center">
                                            <label class="control control--checkbox">
                                                <input type="checkbox" id="deleteckAll"/>
                                                <span class="control__indicator deletechk"></span>
                                            </label>
                                        </th>
                                        <th scope="col">Perfil</th>
                                        <th class="text-truncate">Nome</th>
                                        <th class="text-truncate" style="width: 5rem">Bloqueado</th>
                                    </tr>
                                    </thead>
                                    @forelse($data as $itemTwo)
                                        <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <label class="control control--checkbox">
                                                    <input name="delete[]" value="{{$itemTwo->id}}" type="checkbox" class="deletechk"/>
                                                    <span class="control__indicator deletechk"></span>
                                                </label>
                                            </td>
                                            <td class="text-truncate">{{$itemTwo->role}}</td>
                                            <td class="text-truncate">{{$itemTwo->name}}</td>
                                            <td class="text-truncate">{{Carbon\Carbon::parse($itemTwo->created_at)->format('d/m/Y')}}</td>
                                        </tr>
                                        </tbody>
                                    @empty

                                    @endforelse
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-print-none text-center">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="d-flex justify-content-end">
                                @if(isset($data))
                                    {!! $data->appends(Request::all())->links() !!}
                                @else
                                    {!! $data->links() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#restoreckAll").click(function () {  // minha restorechk que marcará as outras
                if ($("#restoreckAll").prop("checked"))   // se ela estiver marcada...
                    $(".restorechk").prop("checked", true);  // as que estiverem nessa classe ".restorechk" tambem serão marcadas
                else $(".restorechk").prop("checked", false);   // se não, elas tambem serão desmarcadas
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#deleteckAll").click(function () {  // minha deletechk que marcará as outras
                if ($("#deleteckAll").prop("checked"))   // se ela estiver marcada...
                    $(".deletechk").prop("checked", true);  // as que estiverem nessa classe ".deletechk" tambem serão marcadas
                else $(".deletechk").prop("checked", false);   // se não, elas tambem serão desmarcadas
            });
        });
    </script>
@endpush
