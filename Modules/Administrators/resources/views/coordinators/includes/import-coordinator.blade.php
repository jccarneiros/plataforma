<form class="row" action="{{route('administrators.coordinators.import')}}" method="POST"
      enctype="multipart/form-data">
    @csrf
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
        <input type="file" name="select_file"
               class="form-control form-control-sm @error('select_file') is-invalid @enderror">
        @error('select_file')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
        <div class="loading"></div>
        <button type="submit" class="btn btn-sm btn-warning btn-loading w-100">Importar</button>
    </div>
</form>
