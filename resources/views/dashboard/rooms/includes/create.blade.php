@can('rooms.create')
    <form action="{{route('dashboard.rooms.store')}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="with-line left">
                {{$tipoEnsino->name}} / {{$serie->name}}
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="tipo_ensino_id" value="{{$tipoEnsino->id}}">
            <input type="hidden" name="serie_id" value="{{$serie->id}}">
            @if($serie->type !== 'Regular')
                <div hidden="" class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                    <input type="hidden" value="{{$tipoEnsino->name}}" class="form-control form-control-sm"
                           readonly>
                    <input type="hidden" name="tipo_ensino_id" value="{{$tipoEnsino->id}}"
                           class="form-control form-control-sm">
                </div>
                <div hidden="" class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                    <input type="hidden" value="{{$serie->type}}" class="form-control form-control-sm" readonly>
                    <input type="hidden" name="type" value="{{$serie->type}}" class="form-control form-control-sm">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-3">
                    <input type="text" name="name" value="{{old('name')}}"
                           class="form-control form-control-sm @error('name') is-invalid @enderror"
                           placeholder="Digite um nome para a turma" autocomplete="true">
                    @error('name')
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                    <button type="submit" href="{{route('dashboard.rooms.store')}}" class="btn btn-sm btn-success w-100">
                        Salvar
                    </button>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                    <a href="{{route('dashboard.series.index')}}" class="btn btn-sm btn-secondary w-100">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                    <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary w-100">
                        Painel
                    </a>
                </div>
            @else
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-2 mb-2">
                    <input type="text" value="{{$tipoEnsino->name}}" class="form-control form-control-sm"
                           readonly>
                    <input type="hidden" name="tipo_ensino_id" value="{{$tipoEnsino->id}}"
                           class="form-control form-control-sm">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                    <input type="text" value="{{$serie->type}}" class="form-control form-control-sm" readonly>
                    <input type="hidden" name="type" value="{{$serie->type}}" class="form-control form-control-sm">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                    <input type="text" name="name" value="{{old('name')}}"
                           class="form-control form-control-sm @error('name') is-invalid @enderror"
                           placeholder="Nome" autocomplete="true">
                    @error('name')
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                    <select name="room" id="roomSelect"
                            class="form-select form-select-sm @error('letter') is-invalid @enderror">
                        <option value="">Turma</option>
                        @foreach($arrayRoom as $room)
                            <option value="{{$room}}">{{$room}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-3">
                    <select name="letter" id="letterSelect"
                            class="form-select form-select-sm @error('letter') is-invalid @enderror">
                        <option value="">Letra</option>
                        @foreach(range('A', 'Z') as $letter)
                            <option value="{{$letter}}">{{$letter}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                    <button type="submit" href="{{route('dashboard.rooms.store')}}" class="btn btn-sm btn-success w-100">
                        Salvar
                    </button>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                    <a href="{{route('dashboard.series.index')}}" class="btn btn-sm btn-secondary w-100">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                </div>
            @endif
        </div>
    </form>
@endcan
