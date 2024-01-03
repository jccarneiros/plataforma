<form action="{{route('dashboard.tutors.store')}}" method="POST">
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
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <select name="status_tutoria" class="form-select form-control-sm" style="font-size: 90% !important;">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-2">
            <select name="limit_tutoria_students" class="form-select form-select-sm">
                <option value="">Limite</option>
                @foreach(range(1, 30) as $number)
                    <option value="{{$number}}">{{$number}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-2">
            <select name="user_id" class="form-select form-select-sm">
                <option value="">Selecione um tutor</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->role}} | {{$user->name}}</option>
                @endforeach
            </select>
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