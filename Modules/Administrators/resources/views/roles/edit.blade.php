@extends('administrators::layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('administrators')}}">Painel</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('administrators.roles.index')}}">Grupos</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Editar grupo: {{$role->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('administrators.roles.update', $role->id)}}" method="POST" id="form"
                      enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            @foreach($permissions->slice(0, 30) as $permission)
                                <div class="form-check">
                                    <input name="permissions[]" class="form-check-input" type="checkbox"
                                           id="inlineCheckbox1"
                                           value="{{$permission->id}}" @forelse($role->permissions as $rolePermission)
                                        {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                                            @empty

                                            @endforelse
                                    />
                                    <label class="form-check-label"
                                           for="inlineCheckbox1">{{ $permission->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            @foreach($permissions->slice(30) as $permission)
                                <div class="form-check">
                                    <input name="permissions[]" class="form-check-input" type="checkbox"
                                           id="inlineCheckbox1"
                                           value="{{$permission->id}}" @forelse($role->permissions as $rolePermission)
                                        {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                                            @empty

                                            @endforelse
                                    />
                                    <label class="form-check-label"
                                           for="inlineCheckbox1">{{ $permission->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <input type="text" name="name"
                                       class="form-control form-control-sm @error('name') is-invalid @enderror"
                                       placeholder="digite um nome"
                                       value="{{$role->name, old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <button type="submit" class="btn btn-success btn-sm w-100">Salvar</button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <a href="{{route('administrators.roles.index')}}"
                                   class="btn btn-sm btn-secondary w-100">
                                    Voltar
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <a href="{{route('administrators')}}" class="btn btn-sm btn-primary w-100">
                                    Painel
                                </a>
                            </div>
                            <div class="row">
                            </div>

                            {{--                            @include('dashboard.administrators.roles.includes.edit-permissions', ['item' => $role])--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
