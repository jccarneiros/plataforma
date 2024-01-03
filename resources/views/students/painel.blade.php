@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div>
        {{auth()->user()->id}} / {{auth()->user()->name}} / {{auth()->user()->role}}
    </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl mb-3">
                    <a href="{{route('students.tutorias.index', $student->code)}}"
                       class="btn btn-sm btn-info w-100">Tutoria</a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl mb-3">
                    <a href="{{route('students.clubes.index', $student->code)}}"
                       class="btn btn-sm btn-info w-100">Clube</a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl mb-3">
                    <a href="{{route('students.eletivas.index', $student->code)}}"
                       class="btn btn-sm btn-info w-100">Eletivas</a>
                </div>
            </div>
        </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
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

@endsection
