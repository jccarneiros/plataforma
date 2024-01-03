@can('tipo_ensinos.create')
    <div class="col-sm-12 col-md-12 col-lg col-xl">
        <form action="{{route('dashboard.tipo_ensinos.store')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <input type="hidden" name="type" value="Regular">
                <button type="submit" name="name" value="Ensino Fundamental" class="btn btn-sm btn-success w-100">
                    Ensino Fundamental
                </button>
            </div>
        </form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg col-xl">
        <form action="{{route('dashboard.tipo_ensinos.store')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <input type="hidden" name="type" value="Regular">
                <button type="submit" name="name" value="Ensino Médio" class="btn btn-sm btn-success w-100">
                    Ensino Médio
                </button>
            </div>
        </form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg col-xl">
        <form action="{{route('dashboard.tipo_ensinos.store')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <input type="hidden" name="type" value="Diversificada">
                <button type="submit" name="name" value="Itinerário Formativo" class="btn btn-sm btn-success w-100">
                    Itinerário Formativo
                </button>
            </div>
        </form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg col-xl">
        <form action="{{route('dashboard.tipo_ensinos.store')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                <input type="hidden" name="type" value="Regular">
                <button type="submit" name="name" value="Técnico Profissional" class="btn btn-sm btn-success w-100">
                    Técnico Profissional
                </button>
            </div>
        </form>
    </div>
    <form action="{{route('dashboard.tipo_ensinos.store')}}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <select name="type"
                        class="form-select form-select-sm @error('type') is-invalid @enderror">
                    <option value="">Selecione a Modalidade</option>
                    <option value="Regular">Regular</option>
                    <option value="Diversificada">Diversificada</option>
                </select>
                @error('type')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <input type="text"
                       class="form-control form-control-sm @error('name') is-invalid @enderror"
                       name="name" value="{{old('name')}}" placeholder="Digite um nome">
                @error('name')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
            </div>
        </div>
    </form>
@endcan
