<div class="modal fade" id="{{ 'modal_Edit_Discipline' . $discipline->id  }}" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Disciplina: {{$discipline->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('dashboard.disciplines.update', $discipline->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-3">
                            <input type="text" name="name" value="{{$discipline->name, old('name')}}"
                                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                                   placeholder="Digite um nome">
                            @error('name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <button type="submit" class="btn btn-sm btn-warning w-100">Salvar</button>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                            <button type="button" class="btn btn-sm btn-secondary w-100" data-bs-dismiss="modal">
                                <i class="fa-solid fa-rotate-left"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>