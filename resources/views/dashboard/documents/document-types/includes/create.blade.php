<form action="{{route('dashboard.document-types.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
            <input type="hidden" name="area_conhecimento_id" value="{{$areaconhecimento->id}}">
            <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-sm @error('name') is-invalid @enderror"
                   placeholder="Digite um nome">
            @error('name')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <select name="periodicidade" class="form-select form-select-sm @error('periodicidade') is-invalid @enderror">
                <option value="">Periodicidade</option>
                @foreach(array('Anual', 'Semestral', 'Trimestral', 'Bimestral', 'Mensal', 'Quinzenal', 'Diário') as $periodicidade)
                    <option value="{{$periodicidade}}">{{$periodicidade}}</option>
                @endforeach
            </select>
            @error('periodicidade')
            <span class="invalid-feedback"
                  role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
        </div>
    </div>
</form>