@can('series.edit')
    <div class="modal fade" id="{{ 'modal_Edit_Serie' . $item->id  }}" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar: {{$item->tipoEnsino->name}}
                        / {{$item->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('dashboard.series.update', $item->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                                <select name="tipo_ensino_id" id="tipo_ensino_id"
                                        class="form-select form-select-sm">
                                    @foreach($tipoEnsinos as $value)
                                        <option value="{{$value->id}}" {{ $value->id == $item->tipo_ensino_id  ? 'selected' : '' }}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                                <select name="type" id="type" class="form-select form-select-sm @error('type') is-invalid @enderror">
                                    <option value="{{$item->type}}">{{$item->type}}</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Diversificada">Diversificada</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="6º Ano"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">6º
                                    Ano
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="7º Ano"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">7º
                                    Ano
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="8º Ano"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">8º
                                    Ano
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="9º Ano"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">9º
                                    Ano
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="1º Série"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">1º
                                    Série
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="2º Série"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">2º
                                    Série
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="3º Série"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">3º
                                    Série
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                <button type="submit" name="name" value="Eletiva"
                                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">
                                    Eletiva
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg col-xl">
                                <button type="button" class="btn btn-sm btn-secondary w-100"
                                        data-bs-dismiss="modal">Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan