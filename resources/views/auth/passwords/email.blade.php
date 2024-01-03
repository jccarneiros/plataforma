@extends('layouts.login')

@section('content')
    <div class="container mt-5 text-uppercase">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="glassmorphism-form" onclick="toggleFloatAnimation(this)">
                    <h2>REDEFINIR SENHA</h2>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-sm @error('email') is-invalid @enderror"
                               required autofocus autocomplete="true">
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <button type="submit" class="btn btn-sm btn-success w-100 mb-3">ENVIAR LINK DE REDEFINIÇÃO DE SENHA</button>
                    </form>
                    <a class="btn btn-sm btn-secondary w-100" href="{{ route('check') }}">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
