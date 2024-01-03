<form action="{{route('administrators.supervisors.store')}}" method="POST"
      enctype="multipart/form-data">
    @csrf
    <div class="row">
        <h6 class="with-line left">Adicionar Novo Registro</h6>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
            <input type="text" name="name" value="{{old('name')}}"
                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                   placeholder="Digite um nome">
            @error('name')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 mb-3">
            <input type="email" name="email" value="{{old('email')}}"
                   class="form-control form-control-sm @error('email') is-invalid @enderror"
                   placeholder="Digite um email">
            @error('email')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
            <input type="text" name="role" value="Supervisão"
                   class="form-control form-control-sm @error('role') is-invalid @enderror"
                   readonly>
            @error('role')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
            <button type="submit" class="btn btn-sm btn-success mb-3">Salvar</button>
        </div>
    </div>
</form>
