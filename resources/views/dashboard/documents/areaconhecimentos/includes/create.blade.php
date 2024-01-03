<form action="{{route('dashboard.areaconhecimentos.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
            <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-sm @error('name') is-invalid @enderror"
                   placeholder="Digite um nome">
            @error('name')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
        </div>
    </div>
</form>