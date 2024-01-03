@extends('administrators::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 class="with-line left">Editar: {{$management->name}}</h6>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <form action="{{route('administrators.managements.updateAvatar', $management->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                        <div class="row">
                            <input name="_method" type="hidden" value="PUT">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div id="my_camera" class="mb-3"></div>
                                <div>
                                    <input type="button" name="avatar" value="capturar a imagem"
                                           class="text-uppercase btn btn-sm btn-default w-100 mb-3 @error('avatar') is-invalid @enderror"
                                           onClick="take_snapshot()">
                                    @error('avatar')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <button type="submit" class="btn btn-sm btn-success mb-3 w-100">Salvar Imagem
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
                                @if($management->avatar != "")
                                    <img src="{{url('/assets/uploads/images/users/'.$management->avatar)}}"
                                         alt="{{$management->name}}" class="flex-shrink-0 me-2 rounded" width="200"
                                         height="150">
                                @endif
                                <input type="hidden" name="avatar" class="image-tag">
                                <div id="results" style="width: 100%;">Sua imagem capturada...</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <form action="{{route('administrators.managements.update', $management->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <input type="text" name="name" value="{{$management->name, old('name')}}"
                                       class="form-control form-control-sm @error('name') is-invalid @enderror"
                                       placeholder="Digite um nome">
                                @error('name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                <input type="email" name="email" value="{{$management->email, old('email')}}"
                                       class="form-control form-control-sm @error('email') is-invalid @enderror"
                                       placeholder="Digite um email">
                                @error('email')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                    <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                    <a href="{{route('administrators.managements.index')}}"
                                       class="btn btn-sm btn-secondary w-100">Voltar</a>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                    <a href="{{route('administrators')}}"
                                       class="btn btn-sm btn-primary w-100">Painel</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                            @include('administrators::managements.includes.edit-roles', ['management' => $management])
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script language="JavaScript">
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

@endsection
