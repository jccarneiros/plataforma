@can('series.create')
    <form action="{{route('dashboard.series.store')}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                <select name="tipo_ensino_id" id="tipo_ensino_id"
                        class="form-select form-select-sm @error('tipo_ensino_id') is-invalid @enderror">
                    <option value="">Tipo de Ensino</option>
                    @foreach($tipoEnsinos as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                @error('tipo_ensino_id')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                <select name="type"
                        class="form-select form-select-sm @error('type') is-invalid @enderror">
                    <option value="">Modalidade</option>
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
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">6º Ano
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="7º Ano"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">7º Ano
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="8º Ano"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">8º Ano
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="9º Ano"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">9º Ano
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="1º Série"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">1º Série
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="2º Série"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">2º Série
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="3º Série"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">3º Série
                </button>
            </div>
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <button type="submit" name="name" value="Eletiva"
                        class="btn btn-sm btn-success w-100 @error('name') is-invalid @enderror">Eletiva
                </button>
            </div>
            @error('name')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </form>
@endcan