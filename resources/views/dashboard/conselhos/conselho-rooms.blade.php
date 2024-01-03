@extends('layouts.master')

@section('content')
    @push('styles')
        <style>
            .switch {
                --false: #546E7A;
                --true: #EF5350;
            }

            input[type=checkbox] {
                appearance: none;
                height: 1rem;
                width: 3.0rem;
                background-color: #34495e;
                position: relative;
                border-radius: .5em;
                cursor: pointer;
            }

            input[type=checkbox]::before {
                content: '';
                display: block;
                height: .8em;
                width: 1.4em;
                transform: translate(-50%, -50%);
                position: absolute;
                top: 50%;
                left: calc(1.9em / 2 + .3em);
                background-color: var(--false);
                border-radius: .2em;
                transition: .3s ease;
            }

            input[type=checkbox]:checked::before {
                background-color: var(--true);
                left: calc(100% - (1.9em / 2 + .3em));
            }

        </style>
    @endpush
    <div>
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Turma / {{auth()->user()->name}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <table class="table table-sm table-hover table-bordered">
                            <thead class="sticky">
                            <tr>
                                <th style="width: 10rem">Tipo de Ensino</th>
                                <th style="width: 5rem">Série</th>
                                <th>Turma</th>
                                <th style="width: 6rem">Bloquear 1ºB</th>
                                <th style="width: 6rem">Bloquear 2ºB</th>
                                <th style="width: 6rem">Bloquear 3ºB</th>
                                <th style="width: 6rem">Bloquear 4ºB</th>
                                <th style="width: 6rem">Bloquear 5ºC</th>
                                <th style="width: 5rem">Tipo</th>
                                <th style="width: 5rem">Conselho</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rooms as $room)
                                <tr>
                                    <td class="text-truncate">{{$room->tipoEnsino->name}}</td>
                                    <td class="text-truncate">{{$room->serie->name}}</td>
                                    <td class="text-truncate">{{$room->name}}</td>
                                    <td class="text-center">
                                        <form action="{{route('dashboard.students.conselho.escola.updateStatusPrimeiroBimestreRoom', $room->id)}}"
                                              method="POST">
                                            @csrf @method('PUT')
                                            <label class="switch">
                                                <input type="checkbox" name="status_p_b" value="1" onchange="this.form.submit()"
                                                        {{$room->status_p_b == 1 ? 'checked' : ''}}>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('dashboard.students.conselho.escola.updateStatusSegundoBimestreRoom', $room->id)}}"
                                              method="POST">
                                            @csrf @method('PUT')
                                            <label class="switch">
                                                <input type="checkbox" name="status_s_b" value="1" onchange="this.form.submit()"
                                                        {{$room->status_s_b == 1 ? 'checked' : ''}}>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('dashboard.students.conselho.escola.updateStatusTerceiroBimestreRoom', $room->id)}}"
                                              method="POST">
                                            @csrf @method('PUT')
                                            <label class="switch">
                                                <input type="checkbox" name="status_t_b" value="1" onchange="this.form.submit()"
                                                        {{$room->status_t_b == 1 ? 'checked' : ''}}>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('dashboard.students.conselho.escola.updateStatusQuartoBimestreRoom', $room->id)}}"
                                              method="POST">
                                            @csrf @method('PUT')
                                            <label class="switch">
                                                <input type="checkbox" name="status_q_b" value="1" onchange="this.form.submit()"
                                                        {{$room->status_q_b == 1 ? 'checked' : ''}}>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('dashboard.students.conselho.escola.updateStatusQuintoConceitoRoom', $room->id)}}"
                                              method="POST">
                                            @csrf @method('PUT')
                                            <label class="switch">
                                                <input type="checkbox" name="status_q_c" value="1" onchange="this.form.submit()"
                                                        {{$room->status_q_c == 1 ? 'checked' : ''}}>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-truncate">{{$room->type}}</td>
                                    <td class="text-truncate text-center">
                                        <a href="{{route('dashboard.students.conselho.escola.room', $room->id)}}"
                                           class="btn btn-sm btn-info w-100">
                                            {{$room->name}}
                                        </a>
                                    </td>
                                </tr>
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
@endsection

