@extends('administrators::layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary w-100">
                    Painel
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.supervisors.index')}}" class="btn btn-sm btn-primary w-100">
                    Supervisores
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.managements.index')}}" class="btn btn-sm btn-primary w-100">
                    Gestores
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.coordinators.index')}}" class="btn btn-sm btn-primary w-100">
                    Coordenadores
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.secretariats.index')}}" class="btn btn-sm btn-primary w-100">
                    Secretaria
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.teachers.index')}}" class="btn btn-sm btn-primary w-100">
                    Professores
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.roles.index')}}" class="btn btn-sm btn-primary w-100">
                    Grupos
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.backups.index')}}" class="btn btn-sm btn-primary w-100">
                    Backups
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a href="{{route('administrators.configurations.index',$siteInfo->id)}}" class="btn btn-sm btn-primary w-100">
                    Sistema
                </a>
            </div>
            <div class="col sm-12 col-md-12 col-lg col-xl">
                <a class="btn btn-sm btn-danger w-100" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($rooms as $room)
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                    <span class="btn btn-sm btn-outline-info text-center w-100">{{$room->tipoEnsino->name}} - {{$room->name}} - ({{$room->students->count()}})</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection
