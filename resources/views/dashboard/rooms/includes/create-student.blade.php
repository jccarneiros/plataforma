@can('students.create')
    <form action="{{route('dashboard.students.store')}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tipo_ensino_id" value="{{$room->tipoEnsino->id}}">
        <input type="hidden" name="serie_id" value="{{$room->serie->id}}">
        <input type="hidden" name="room_id" value="{{$room->id}}">
        <input type="hidden" name="type" value="{{$room->type}}">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                <select name="number" class="form-select form-select-sm"
                        @error('number') is-invalid @enderror>
                    <option value="">Nº</option>
                    @foreach(range(1,100) as $value)
                        <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select>
                @error('number') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <input type="text" name="number_ra" id="number_ra" class="form-control form-control-sm"
                       placeholder="Nº RA" value="{{old('number_ra')}}"
                       @error('number_ra') is-invalid @enderror>
                @error('number_ra') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                <input type="text" name="number_ra_digit" class="form-control form-control-sm"
                       placeholder="Dígito RA" value="{{old('number_ra_digit')}}"
                       @error('number_ra_digit') is-invalid @enderror>
                @error('number_ra_digit') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                <input type="text" name="uf_ra" value="SP" class="form-control form-control-sm" readonly>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <input type="date" name="date_birth" class="form-control form-control-sm"
                       placeholder="Aniversário" value="{{old('date_birth')}}"
                       @error('date_birth') is-invalid @enderror>
                @error('date_birth') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                <input type="text" name="name" value="{{old('name')}}"
                       class="form-control form-control-sm @error('name') is-invalid @enderror"
                       placeholder="Digite um nome para o aluno" autocomplete="on">
                @error('name')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                <button type="submit" class="btn btn-sm btn-success w-100">
                    Salvar
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                <input type="hidden" name="email_microsoft" id="email_microsoft" value="{{old('email_microsoft')}}"
                       class="form-control form-control-sm @error('email_microsoft') is-invalid @enderror"
                       placeholder="Exemplo: 00005566778899sp@aluno.educacao.sp.gov.br" autocomplete="off">
                @error('email_microsoft')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                <input type="hidden" name="email_google" value="{{old('email_google')}}"
                       class="form-control form-control-sm @error('email_google') is-invalid @enderror"
                       placeholder="Exemplo: 00005566778899sp@al.educacao.sp.gov.br" autocomplete="off">
                @error('email_google')
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                <input type="hidden" name="student_situation" value="Ativo" class="form-control form-control-sm" readonly>
            </div>
        </div>
    </form>
@endcan
@push('scripts')
    <script>
        function adicionarTexto(event) {
            event.preventDefault();
            const number_ra = document.getElementById("number_ra").value;
            document.getElementById("email_microsoft").innerHTML += number_ra + " ";
        }
    </script>
@endpush
