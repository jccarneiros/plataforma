@extends('layouts.student')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header text-uppercase">
                    <a href="{{route('painel.students', $student->code)}}" class="btn btn-sm btn-secondary w-100">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{--VERIFICA SE EXISTE O ID DO ESTUDANTE NA TABELA ELETIVAS--}}
                    @if (isset($student->eletiva->student_id) && $student->eletiva->student_id == $student->id)
                        <div class="row">
                            <div class="card">
                                <div class="card-header text-uppercase text-center">
                                    <span style="font-size: 80%"> {{$student->name}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="card text-center">
                                    <div class="card-body" style="min-height: 15rem!important;">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <div class="mt-2">
                                                @if($student->eletiva->professor->user->avatar != null)
                                                    <img src="{{url('/assets/uploads/images/users/'.$student->eletiva->professor->user->avatar)}}"
                                                         alt=""
                                                         class="rounded"
                                                         width="100%" height="auto">
                                                @else
                                                    <img src="{{asset('/images/user-picture.png')}}" alt=""
                                                         class="rounded"
                                                         width="100%" height="auto">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-header mt-3"
                                             style="font-size: 80%!important;">
                                            Eletiva: {{$student->eletiva->professor->name_eletiva}}
                                        </div>
                                        <div class="card-header"
                                             style="font-size: 80%!important;">
                                            Professor: {{$student->eletiva->professor->user->name}}
                                        </div>
                                        <div class="card-header"
                                             style="font-size: 80%!important;">
                                            Sala: {{$student->eletiva->professor->sala->name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($professors as $professor)
                            @if($professor->status_eletiva == 1)
                                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                    <form action="{{route('students.eletivas.selectProfessor', $student->code)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="professor_id" value="{{$professor->id}}">
                                        <input type="hidden" name="student_id" value="{{$student->id}}">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 15rem!important;">
                                                <div class="card-header" style="font-size: 80%!important;">
                                                    {{$professor->user->name}}
                                                </div>
                                                <div class="card-header" style="font-size: 80%!important;">
                                                    {{$professor->name_eletiva}}
                                                </div>
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <div class="mt-0">
                                                        @if($professor->user->avatar != null)
                                                            <img src="{{url('/assets/uploads/images/users/'.$professor->user->avatar)}}"
                                                                 alt=""
                                                                 class="rounded"
                                                                 width="100%" height="auto">
                                                        @else
                                                            <img src="{{asset('/images/user-picture.png')}}" alt=""
                                                                 class="rounded"
                                                                 width="100%" height="auto">
                                                        @endif
                                                    </div>
                                                    @if($professor->limit_eletiva_students == $professor->students->count())

                                                        <button class="btn btn-sm btn-secondary w-100" disabled>
                                                            Indisponível [ {{$professor->students->count()}} ] de
                                                            [ {{$professor->limit_eletiva_students}} ]
                                                        </button>
                                                    @else
                                                        <button type="submit"
                                                                class="btn btn-sm btn-secondary w-100">
                                                            Vagas Disponíveis:
                                                            [ {{$professor->limit_eletiva_students - $professor->students->count()}} ]
                                                            {{--                                                                de [ {{$professor->limit_eletiva_students}} ]--}}
                                                        </button>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
