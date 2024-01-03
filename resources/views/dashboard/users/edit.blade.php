@extends('layouts.master')

@section('content')
    @can('users.edit')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <form action="{{route('dashboard.users.updateAvatar', $item->id)}}" method="POST"
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
                                    @if($item->avatar != '')
                                        <img src="{{url('/assets/uploads/images/users/'.$item->avatar)}}"
                                             alt="{{$item->name}}" class="flex-shrink-0 me-2 rounded" width="200"
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
                    <form action="{{route('dashboard.users.update', $item->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                    <input type="text" name="name" value="{{$item->name, old('name')}}"
                                           class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                    <input type="email" name="email" value="{{$item->email, old('email')}}"
                                           class="form-control form-control-sm" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                        <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                        <a href="{{route('dashboard.users.index')}}"
                                           class="btn btn-sm btn-secondary w-100">Voltar</a>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg col-xl mb-3">
                                        <a href="{{route('dashboard')}}"
                                           class="btn btn-sm btn-primary w-100">Painel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
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
