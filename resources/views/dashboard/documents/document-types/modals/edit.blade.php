@can('documents.edit')
    <div class="modal fade" id="{{ 'modal_Edit_DocumentType' . $item->id  }}" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar: {{$item->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('dashboard.document-types.update', $item->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <input type="text" name="name" value="{{$item->name, old('name')}}"
                                       class="form-control form-control-sm @error('name') is-invalid @enderror"
                                       placeholder="Digite um nome">
                                @error('name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <select name="periodicidade" class="form-select form-select-sm @error('periodicidade') is-invalid @enderror">
                                    <option value="">Periodicidade</option>
                                    @foreach(array('Anual', 'Semestral', 'Trimestral', 'Bimestral', 'Mensal', 'Quinzenal', 'Diário') as $periodicidade)
                                        <option value="{{$periodicidade}}" {{$periodicidade == $item->periodicidade ? 'selected' : ''}}>{{$periodicidade}}</option>
                                    @endforeach
                                </select>
                                @error('periodicidade')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <button type="submit" class="btn btn-sm btn-warning w-100">Salvar</button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
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
@endcan