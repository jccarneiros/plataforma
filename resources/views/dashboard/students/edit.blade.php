@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="with-line left">Editar: {{$item->name}}</div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 border p-3 mb-3">
                <form action="{{route('dashboard.students.update', $item->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="number">Número</label>
                            <select name="number" id="number" class="form-select form-select-sm"
                                    @error('number') is-invalid @enderror>
                                <option value="{{$item->number}}" selected>{{$item->number}}</option>
                                @foreach(range(1,100) as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('number') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="number_ra">Número RA</label>
                            <input type="text" name="number_ra" id="number_ra" class="form-control form-control-sm"
                                   placeholder="Nº RA" value="{{$item->number_ra,old('number_ra')}}" autocomplete="off"
                                   @error('number_ra') is-invalid @enderror>
                            @error('number_ra') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <label for="number_ra_digit">Dígito</label>
                            <input type="text" name="number_ra_digit" id="number_ra_digit" class="form-control form-control-sm"
                                   placeholder="Dígito RA" value="{{$item->number_ra_digit,old('number_ra_digit')}}"
                                   @error('number_ra_digit') is-invalid @enderror>
                            @error('number_ra_digit') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <label for="uf_ra">UF</label>
                            <input type="text" name="uf_ra" id="uf_ra" value="SP" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <label for="name">Nome Completo</label>
                            <input type="text" name="name" id="name" value="{{$item->name,old('name')}}"
                                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                                   placeholder="Digite um nome para o aluno" autocomplete="off">
                            @error('name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                            <label for="date_birth">Data de Nascimento</label>
                            <input type="date" name="date_birth" id="date_birth" class="form-control form-control-sm"
                                   placeholder="Aniversário" value="{{$item->date_birth,old('date_birth')}}"
                                   @error('date_birth') is-invalid @enderror>
                            @error('date_birth') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="uf_ra">Atualizar</label>
                            <button type="submit" class="btn btn-sm btn-warning w-100">
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
                            <input type="hidden" name="student_situation" value="{{$item->student_situation}}" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                            <input type="hidden" name="type" value="{{$item->type}}" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-3">
                            <input type="hidden" name="slug" value="{{$item->slug}}" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-8 col-xl-8">
                <form action="{{route('dashboard.students.updateAvatar', $item->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <div id="my_camera" class="mb-3"></div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            @if($item->avatar != "")
                                <img src="{{url('/assets/uploads/images/users/'.$item->avatar)}}"
                                     alt="{{$item->name}}" class="flex-shrink-0 rounded mb-3" width="200"
                                     height="150">
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="hidden" name="avatar" class="image-tag">
                            <div id="results" class="mb-3" style="width: 100%;">nova imagem
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <input type="button" name="avatar" value="capturar a imagem"
                                   class="text-uppercase btn btn-sm btn-default w-100 mb-3"
                                   onClick="take_snapshot()">
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <button type="submit" class="btn btn-sm btn-success w-100 mb-3">Salvar
                            </button>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <a href="{{route('dashboard.students.index')}}"
                               class="btn btn-sm btn-secondary mb-3 w-100">
                                Voltar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        Webcam.set({
            width: 200,
            height: 150,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
@endpush