@extends('layouts.login')

@section('content')
    @if(empty($user))
        <div class="container mt-5 pt-5">
            <div class="row mt-5 pt-5">
                <div class="col-md-4 offset-md-4 text-uppercase">
                    <a href="{{route('welcome')}}" class="btn btn-warning w-100">Faça login novamente</a>
                </div>
            </div>
        </div>

    @else
        <div class="container mt-5 text-uppercase">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="glassmorphism-form" onclick="toggleFloatAnimation(this)">
                        <h2 style="color: #cccccc;">Acessar plataforma</h2>
                        <form action="{{route('login.dashboard')}}" method="POST">
                            @csrf
                            <input type="text" name="email" value="{{$user->email}}"
                                   class="form-control form-control-sm"
                                   readonly required>
                            <input type="password" name="password" class="form-control form-control-sm"
                                   placeholder="Senha" required
                                   autofocus>
                            <button type="submit" class="btn btn-sm btn-success w-100 mb-3">Entrar</button>
                        </form>
                        @if (Route::has('password.request'))
                            <a class="btn btn-sm btn-success w-100 mb-3" href="{{ route('password.request') }}">
                                Alterar minha senha
                            </a>
                        @endif
                        <a class="btn btn-sm btn-secondary w-100" href="{{ route('check') }}">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
