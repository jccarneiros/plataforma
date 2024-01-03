<form action="{{route('dashboard.document-periods.store')}}" method="POST">
    @csrf
    <div class="row mb-3">
        <input type="hidden" name="area_conhecimento_id" value="{{$areaconhecimento->id}}">
        <input type="hidden" name="document_type_id" value="{{$documenttype->id}}">
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <label for="name" class="text-white-50">Área de Conhecimento</label>
            <input type="text" value="{{$areaconhecimento->name}}" class="form-control form-control-sm" readonly>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <label for="name" class="text-white-50">Tipo de Documento</label>
            <input type="text" value="{{$documenttype->name}}" class="form-control form-control-sm" readonly>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <label for="name" class="text-white-50">Periodicidade</label>
            <input type="text" name="periodicidade" value="{{$documenttype->periodicidade}}" class="form-control form-control-sm" readonly>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <label for="name" class="text-white-50">Referência</label>
            <select name="referencia" class="form-select form-select-sm @error('referencia') is-invalid @enderror">
                @switch($documenttype->periodicidade)
                    @case($documenttype->periodicidade === "Anual")
                        <option value="">Selecione a Referência</option>
                        @foreach(array('2023', '2024', '2025', '2026') as $rowYear)
                            <option value="{{$rowYear}}">{{$rowYear}}</option>
                        @endforeach
                        @break
                    @case($documenttype->periodicidade === "Semestral")
                        <option value="">Selecione a Referência</option>
                        @foreach(array('1º semestre', '2º semestre') as $rowSemestre)
                            <option value="{{$rowSemestre}}">{{$rowSemestre}}</option>
                        @endforeach
                        @break
                    @case($documenttype->periodicidade === "Bimestral")
                        <option value="">Selecione a Referência</option>
                        @foreach(array('1º bimestre', '2º bimestre', '3º bimestre', '4º bimestre') as $rowBimestre)
                            <option value="{{$rowBimestre}}">{{$rowBimestre}}</option>
                        @endforeach
                        @break
                    @case($documenttype->periodicidade === "Mensal")
                        <option value="">Selecione a Referência</option>
                        @foreach(array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro') as $rowMonth)
                            <option value="{{$rowMonth}}">{{$rowMonth}}</option>
                        @endforeach
                        @break
                    @case($documenttype->periodicidade === "Quinzenal")
                        <option value="">Selecione a Referência</option>
                        @foreach(array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro') as $rowQuinzena)
                            <option value="{{$rowQuinzena}}">{{$rowQuinzena}}</option>
                        @endforeach
                        @break
                @endswitch
            </select>
            @error('referencia')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <label for="title" class="text-white-50">Data Inicial</label>
            <input type="date" name="date_initial"
                   value="{{old('date_initial')}}" class="form-control form-control-sm @error('date_initial') is-invalid @enderror">
            @error('date_initial')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <label for="title" class="text-white-50">Data Final</label>
            <input type="date" name="date_final"
                   value="{{old('date_final')}}" class="form-control form-control-sm @error('date_final') is-invalid @enderror">
            @error('date_final')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <label for="title" class="text-white-50">Limite para entrega</label>
            <input type="date" name="date_limit"
                   value="{{old('date_limit')}}" class="form-control form-control-sm @error('date_limit') is-invalid @enderror">
            @error('date_limit')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <label for="title" class="text-white-50">Nome para o documento</label>
            <input type="text" name="name" value="{{$documenttype->name}}"
                   class="form-control form-control-sm @error('name') is-invalid @enderror" readonly>
            @error('name') <span class="text-danger">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="row border border-1 pt-2 pb-3">
        <h5 class="text-white">Dados Opcionais</h5>
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>Solicitar Tipo de Ensino?</th>
                    <th>Solicitar Série?</th>
                    <th>Solicitar Disciplina?</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="form-check form-check-inline">
                            <input name="tipo_ensino" class="form-check-input" type="radio" id="tipo_ensino1" value="1">
                            <label class="form-check-label" for="tipo_ensino1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="tipo_ensino" class="form-check-input" type="radio" id="tipo_ensino2" value="0">
                            <label class="form-check-label" for="tipo_ensino2">Não</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input name="serie" class="form-check-input" type="radio" id="serie1" value="1">
                            <label class="form-check-label" for="serie1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="serie" class="form-check-input" type="radio" id="serie2" value="0">
                            <label class="form-check-label" for="serie2">Não</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input name="disciplina" class="form-check-input" type="radio" id="disciplina1" value="1">
                            <label class="form-check-label" for="disciplina1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="disciplina" class="form-check-input" type="radio" id="disciplina2" value="0">
                            <label class="form-check-label" for="disciplina2">Não</label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <label for="title" class="text-white-50">Salvar</label>
            <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
        </div>
    </div>
</form>