<form action="{{route('administrators.roles.store')}}" method="POST" id="form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
            <input type="text" name="name"
                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                   placeholder="Digite um nome para o grupo" value="{{old('name') }}" autocomplete="off">
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-submit w-100">Salvar</button>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
            <a href="{{route('administrators')}}" class="btn btn-sm btn-primary w-100">Painel</a>
        </div>
    </div>
</form>
