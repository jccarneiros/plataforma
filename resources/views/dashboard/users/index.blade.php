@extends('layouts.master')

@section('content')
    @can('users.index')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <select name="filterStudentProfile" id="" class="form-select form-select-sm"
                                    onchange="location = this.value;">
                                <option value="">Perfil</option>
                                @foreach($profiles as $profile)
                                    <option value="{{route('dashboard.users.filterUserProfile', $profile->role)}}">
                                        <a href="{{route('dashboard.users.filterUserProfile', $profile->role)}}">{{$profile->role}}</a>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <form method="GET" action="{{route('dashboard.users.index')}}">
                                <div class="input-group">
                                    <input id="title" name="searchStudentEmail" type="search"
                                           class="form-control form-control-sm" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-outline-primary btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                            <a href="{{route('dashboard.users.index')}}" class="btn btn-sm btn-primary w-100">Todos</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active text-white-50 card-header" id="listUser-tab" data-bs-toggle="tab"
                                            data-bs-target="#listUser-tab-pane"
                                            type="button"
                                            role="tab" aria-controls="listUser-tab-pane" aria-selected="false">Listar Usuários
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-white-50 card-header" id="managerUser-tab" data-bs-toggle="tab"
                                            data-bs-target="#managerUser-tab-pane"
                                            type="button" role="tab" aria-controls="managerUser-tab-pane" aria-selected="true">Gerenciar Usuários
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                            <div class="d-flex justify-content-end">
                                @if(isset($users))
                                    {!! $users->appends(Request::all())->links() !!}
                                @else
                                    {!! $users->links() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="listUser-tab-pane" role="tabpanel" aria-labelledby="listUser-tab"
                                 tabindex="0">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseInfoStatusUser"
                                                    aria-expanded="false" aria-controls="collapseInfoStatusUser">
                                                <i class="fa-regular fa-circle-question"></i>
                                            </button>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                            @can('users.onlyTrashed')
                                                <a href="{{route('dashboard.users.allTrashed')}}"
                                                   class="btn btn-sm btn-info w-100">Bloqueados</a>
                                            @endcan
                                        </div>

                                        <div class="collapse text-white-75" id="collapseInfoStatusUser">
                                            <hr>
                                            Ao inativar um usuário, ele não terá mais acesso a plataforma, mas os conteúdos gerados
                                            por ele continuarão acessíveis.
                                            <hr>
                                        </div>
                                    </div>
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col" style="width: 6rem">Perfil</th>
                                            <th scope="col" style="width: 1rem">Status</th>
                                            @can('users.edit')
                                                <th scope="col" style="width: 10rem !important;">Ativar/Inativar</th>
                                            @endcan
                                            <th scope="col" style="width: 2rem">Criado</th>
                                            @can('users.edit')
                                                <th style="width: 3rem">Editar</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($users as $item)
                                            <tr>
                                                <td class="text-truncate">
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#imageUser{{$item->id}}"
                                                       style="cursor: pointer">
                                                        {{$item->name}}
                                                    </a>
                                                </td>
                                                <td class="text-truncate">{{$item->email}}</td>
                                                <td class="text-truncate">{{$item->role}}</td>
                                                <td class="text-truncate text-center">
                                                    @if($item->active == 1)
                                                        <span><i class="fa-solid fa-circle text-success"></i></span>
                                                    @elseif($item->active == 0)
                                                        <span><i class="fa-solid fa-circle text-danger"></i></span>
                                                    @endif
                                                </td>
                                                <td class="text-truncate">
                                                    @if($item->super_admin)

                                                    @else
                                                        @can('users.edit')
                                                            <form action="{{route('dashboard.users.updateActive', $item->id)}}"
                                                                  method="POST">
                                                                @csrf @method('PUT')
                                                                <div class="form-check form-check-inline"
                                                                     style="font-size: 100% !important;">
                                                                    <input class="form-check-input" type="radio" name="active"
                                                                           id="inlineRadio1"
                                                                           value="1"
                                                                           onclick="this.form.submit()" {{$item->active != 0 ? 'checked': ''}}>
                                                                    <label class="form-check-label" for="inlineRadio1">Ativar</label>
                                                                </div>
                                                                <div class="form-check form-check-inline"
                                                                     style="font-size: 100% !important;">
                                                                    <input class="form-check-input" type="radio" name="active"
                                                                           id="inlineRadio2"
                                                                           value="0"
                                                                           onclick="this.form.submit()" {{$item->active != 1 ? 'checked': ''}}>
                                                                    <label class="form-check-label"
                                                                           for="inlineRadio2">Inativar</label>
                                                                </div>
                                                            </form>
                                                        @endcan
                                                    @endif
                                                </td>
                                                <td class="text-truncate text-center">
                                                    {{ \Carbon\Carbon::parse($item->create_at)->format('d/m/Y') }}
                                                </td>
                                                <td class="text-truncate text-center">
                                                    @can('users.edit')
                                                        @if($item->super_admin)

                                                        @else
                                                            <a href="{{route('dashboard.users.edit', $item->id)}}"
                                                               class="btn btn-sm btn-warning">
                                                                <i class="fa-solid fa-user-pen"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>
                                            @include('dashboard.users.modals.image-user', ['item' =>$item])
                                        @empty
                                            <h6>Nenhum registro até o momento!</h6>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="managerUser-tab-pane" role="tabpanel" aria-labelledby="managerUser-tab"
                                 tabindex="0">
                                {{--                                <div class="row mb-3">--}}
                                <form method="POST" action="{{route('dashboard.users.deleteUsers')}}">
                                    @csrf
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseInfoBloquearUser"
                                                        aria-expanded="false" aria-controls="collapseInfoBloquearUser">
                                                    <i class="fa-regular fa-circle-question"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                                @can('users.delete')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                                            {{--                                                            data-confirm-delete="true"--}}
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Excluir Registros Selecionados">
                                                        Bloquear
                                                    </button>
                                                @endcan
                                            </div>
                                            <div class="collapse text-white-75" id="collapseInfoBloquearUser">
                                                <hr>
                                                Ao bloquear um usuário, ele não terá mais acesso a plataforma e os conteúdos gerados
                                                por ele não estarão acessíveis.
                                                <hr>
                                            </div>
                                        </div>
                                        <table class="table table-sm table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="10px" class="text-center">
                                                    <label class="control control--checkbox">
                                                        <input type="checkbox" id="ckAll"/>
                                                        <span class="control__indicator chk"></span>
                                                    </label>
                                                </th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">E-mail</th>
                                                <th scope="col" style="width: 6rem">Perfil</th>
                                                <th scope="col" style="width: 1rem">Status</th>
                                                <th scope="col" style="width: 2rem">Criado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($users as $item)
                                                <tr>
                                                    <td class="text-center">
                                                        @if($item->super_admin)

                                                        @else
                                                            <label class="control control--checkbox">
                                                                <input name="delete[]" value="{{$item->id}}" type="checkbox"
                                                                       class="chk"/>
                                                                <span class="control__indicator chk"></span>
                                                            </label>
                                                        @endif

                                                    </td>
                                                    <td class="text-truncate">{{$item->name}}</td>
                                                    <td class="text-truncate">{{$item->email}}</td>
                                                    <td class="text-truncate">{{$item->role}}</td>
                                                    <td class="text-truncate text-center">
                                                        @if($item->active == 1)
                                                            <span><i class="fa-solid fa-circle text-success"></i></span>
                                                        @elseif($item->active == 0)
                                                            <span><i class="fa-solid fa-circle text-danger"></i></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-truncate text-center">
                                                        {{ \Carbon\Carbon::parse($item->create_at)->format('d/m/Y') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <h6>Nenhum registro até o momento!</h6>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $("#ckAll").click(function () {  // minha chk que marcará as outras
                if ($("#ckAll").prop("checked"))   // se ela estiver marcada...
                    $(".chk").prop("checked", true);  // as que estiverem nessa classe ".chk" tambem serão marcadas
                else $(".chk").prop("checked", false);   // se não, elas tambem serão desmarcadas
            });
        });
    </script>
@endpush

