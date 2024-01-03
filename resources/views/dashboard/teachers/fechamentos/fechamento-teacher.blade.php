@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page"><span
                                        class="fw-bold">Lançamento de Notas: </span> {{auth()->user()->name}}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"
                                aria-current="page"><span
                                        class="fw-bold">Disciplina:</span> {{$discipline->room->name}}
                                / {{$discipline->name}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card-body">
                @if($discipline->fechamentos->count() >= 1 )
                    <div class="row">
                        <div class="label-room-custom rounded-top">
                            <div class="row text-uppercase text-center">
                                <div class="col-sm-12 col-md-12 col-lg-11 col-xl-11">
                                    <span class="text-uppercase text-danger">após importar ou digitar as notas, atualçize os dados!</span>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                    <a class="btn btn-sm btn-secondary text-uppercase w-100"
                                       href="{{route('dashboard.disciplines.teachers.index')}}">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            @if($discipline->room->status_p_b !== 1)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-toggle="modal"
                                        data-bs-target="#modalPrimeiroBimestre">
                                    1º Bimestre
                                </button>
                            @else
                                <div class="row text-uppercase text-center mb-3">
                                    <span class="text-uppercase text-warning">Bimestre Bloqueado!</span>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            @if($discipline->room->status_s_b !== 1)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-toggle="modal"
                                        data-bs-target="#modalSegundoBimestre">
                                    2º Bimestre
                                </button>
                            @else
                                <div class="row text-uppercase text-center mb-3">
                                    <span class="text-uppercase text-warning">Bimestre Bloqueado!</span>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            @if($discipline->room->status_t_b !== 1)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-toggle="modal"
                                        data-bs-target="#modalTerceiroBimestre">
                                    3º Bimestre
                                </button>
                            @else
                                <div class="row text-uppercase text-center mb-3">
                                    <span class="text-uppercase text-warning">Bimestre Bloqueado!</span>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            @if($discipline->room->status_q_b !== 1)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-toggle="modal"
                                        data-bs-target="#modalQuartoBimestre">
                                    4º Bimestre
                                </button>
                            @else
                                <div class="row text-uppercase text-center mb-3">
                                    <span class="text-uppercase text-warning">Bimestre Bloqueado!</span>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            @if($discipline->room->status_q_c !== 1)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-toggle="modal"
                                        data-bs-target="#modalQuintoConceito">
                                    5º Conceito
                                </button>
                            @else
                                <div class="row text-uppercase text-center mb-3">
                                    <span class="text-uppercase text-warning">Bimestre Bloqueado!</span>
                                </div>
                            @endif
                        </div>
                        @include('dashboard.teachers.fechamentos.modals.primeiro-bimestre')
                        @include('dashboard.teachers.fechamentos.modals.segundo-bimestre')
                        @include('dashboard.teachers.fechamentos.modals.terceiro-bimestre')
                        @include('dashboard.teachers.fechamentos.modals.quarto-bimestre')
                        @include('dashboard.teachers.fechamentos.modals.quinto-conceito')
                    </div>
                    <div class="row">
                        {{--                            <div class="table-responsive">--}}
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" colspan="6" class="text-uppercase"
                                    style="background-color: #607d8b !important;color: #ffffff !important;">
                                    Disciplina: {{$discipline->name}}</th>
                                <th scope="col" colspan="4" class="text-uppercase"
                                    style="background-color: #607d8b !important;color: #ffffff !important;">
                                    {{$discipline->user->name}}</th>
                            </tr>
                            @include('dashboard.teachers.fechamentos.includes.inputs-table-disciplines-aulas-update')
                            </thead>
                        </table>
                        {{--                            </div>--}}

                        @if ($discipline->t_a_d_ano == null)
                            <div class="text-center">
                                Para fazer o lançamento das notas, digite as aulas previstas e dadas
                            </div>
                        @elseif ($discipline->t_a_d_ano == '0')
                            <div class="text-center">
                                Para fazer o lançamento das notas, digite as aulas previstas e dadas
                            </div>
                        @else
                            {{--                                <div class="table-responsive">--}}
                            <form action="{{route('dashboard.fechamentos.updateFechamentoStudents',$discipline->code)}}"
                                  method="post">
                                @csrf @method('PUT')
                                <div class="row">
                                    <button type="submit" class="btn btn-sm btn-warning text-uppercase w-100">clique aqui para Atualizar os
                                        dados
                                    </button>
                                </div>
                                <div class="row">
                                    @include('dashboard.teachers.fechamentos.includes.table-list-fechamentos')
                                </div>
                            </form>
                            {{--                                </div>--}}
                        @endif
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                @else
                    <div class="row mb-5 mt-5">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                            <span class="text-uppercase text-danger fw-bold">Solicite ao administrador da plataforma para criar sua tabela!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="col-md-6 offset-md-3">
                                <a class="btn btn-sm btn-secondary text-uppercase w-100"
                                   href="{{route('dashboard.disciplines.teachers.index')}}">
                                    Clique aqui para voltar
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection