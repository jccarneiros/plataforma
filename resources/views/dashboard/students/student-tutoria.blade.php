@extends('layouts.student')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                <div class="card">
                    <div class="card-header text-uppercase">
                        <a href="{{route('dashboard.students')}}" class="btn btn-sm btn-secondary w-100">Voltar</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{--VERIFICA SE EXISTE O ID DO ESTUDANTE NA TABELA TUTORADOS--}}
                        @if (isset($student->tutoria->student_id) && $student->tutoria->student_id == $student->id)
                            <div class="row">
                                <div class="card">
                                    <div class="card-header text-uppercase text-center">
                                        {{$student->name}}
                                    </div>
                                    <div class="card-header text-uppercase text-center">
                                        Informações
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card text-center">
                                        <div class="card-body" style="min-height: 15rem!important;">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <div class="mt-2">
                                                    @if($student->tutoria->tutor->user->avatar != null)
                                                        <img src="{{url('/assets/uploads/images/users/'.$student->tutoria->tutor->user->avatar)}}"
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
                                                 style="font-size: 75%!important;">
                                                Tutor: {{$student->tutoria->tutor->user->name}}
                                            </div>
                                            <div class="card-header"
                                                 style="font-size: 75%!important;">
                                                Sala: {{$student->tutoria->tutor->sala->name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($tutors as $tutor)
                                @if($tutor->status_tutoria == 1)
                                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                        <form action="{{route('students.tutorias.selectTutor')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="tutor_id" value="{{$tutor->id}}">
                                            <input type="hidden" name="student_id" value="{{$student->id}}">
                                            <div class="card">
                                                <div class="card-body" style="min-height: 15rem!important;">
                                                    <div class="card-header"
                                                         style="font-size: 70%!important;">
                                                        {{$tutor->user->name}}
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center text-center">
                                                        <div class="mt-0">
                                                            @if($tutor->user->avatar != null)
                                                                <img src="{{url('/assets/uploads/images/users/'.$tutor->user->avatar)}}"
                                                                     alt=""
                                                                     class="rounded"
                                                                     width="100%" height="auto">
                                                            @else
                                                                <img src="{{asset('/images/user-picture.png')}}" alt=""
                                                                     class="rounded"
                                                                     width="100%" height="auto">
                                                            @endif
                                                        </div>
                                                        @if($tutor->limit_tutoria_students == $tutor->students->count())

                                                            <button class="btn btn-sm btn-secondary w-100" disabled>
                                                                Indisponível [ {{$tutor->students->count()}} ] de [ {{$tutor->limit_tutoria_students}} ]
                                                            </button>
                                                        @else
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-secondary w-100">
                                                               Vagas Disponíveis:  [ {{$tutor->limit_tutoria_students - $tutor->students->count()}} ]
{{--                                                               de [ {{$tutor->limit_tutoria_students}} ]--}}
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
@endsection
