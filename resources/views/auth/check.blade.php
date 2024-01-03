@extends('layouts.login')

@section('content')
    <div class="container mt-5 text-uppercase">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="glassmorphism-form" onclick="toggleFloatAnimation(this)">
                    <h2>VERIFICAR E-MAIL</h2>
                    <form id="login-form" action="{{route('check.email')}}" method="GET">
                        <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-sm"
                               required autofocus autocomplete="true">
                        <button type="submit" class="btn btn-sm btn-success w-100 mb-3">Verificar E-mail</button>
                    </form>
                    <a class="btn btn-sm btn-secondary w-100" href="{{ route('welcome') }}">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
