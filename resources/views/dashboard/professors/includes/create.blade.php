<form action="{{route('dashboard.professors.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-2">
            <select name="sala_id" class="form-select form-select-sm">
                <option value="">Selecione uma sala</option>
                @foreach($salas as $sala)
                    <option value="{{$sala->id}}">{{$sala->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
            <select name="status_eletiva" class="form-select form-control-sm" style="font-size: 90% !important;">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-2">
            <select name="limit_eletiva_students" class="form-select form-select-sm">
                <option value="">Limite</option>
                @foreach(range(1, 50) as $number)
                    <option value="{{$number}}">{{$number}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-2">
            <select name="user_id" class="form-select form-select-sm">
                <option value="">Selecione um professor</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->role}} | {{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-2">
            <input type="text" name="name_eletiva" value="{{old('name_eletiva')}}" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Nome do eletiva">
            @error('name_eletiva')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-2">
            <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-2">
            <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary w-100">
                Painel
            </a>
        </div>
    </div>
</form>