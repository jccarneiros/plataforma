@extends('layouts.register-outputs-students')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="filterTipoEnsino" class="text-uppercase">Filtrar por Tipo de Ensino - Total:
                        @if(isset($registerTipoEnsinos))
                            {{$registerTipoEnsinos}}
                        @endif</label>
                    <form action="{{route('painel.estudantes.filter.saidas.tipo.ensino', [\Carbon\Carbon::now('America/Sao_Paulo')->monthName, \Carbon\Carbon::now('America/Sao_Paulo')->day])}}"
                          method="GET">
                        <select name="filterTipoEnsino" id="" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Selecione o Tipo de Ensino</option>
                            @foreach($tipoEnsinos as $tipo_ensino)
                                @if(isset($filterTipoEnsino))
                                    <option value="{{$tipo_ensino->id}}" {{$tipo_ensino->id == $filterTipoEnsino ? 'selected' : ''}}>{{$tipo_ensino->name}}</option>
                                @else
                                    <option value="{{$tipo_ensino->id}}">{{$tipo_ensino->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <a href="{{route('painel.estudantes.registrar.saidas', [\Carbon\Carbon::now('America/Sao_Paulo')->monthName, \Carbon\Carbon::now('America/Sao_Paulo')->day])}}"
                           class="btn btn-sm btn-secondary w-100 text-uppercase">Limpar Filtro</a>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button class="btn btn-sm btn-primary w-100" disabled>ENCOSTE O QRCODE NA CÂMERA</button>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <video id="preview" style="width: 100% !important;"></video>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button class="btn btn-sm btn-success w-100" id="totalStudents">TOTAL de Alunos: {{$registersDay->count()}}</button>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <a href="{{route('painel.alunos.index')}}" class="btn btn-sm btn-secondary w-100">Sair</a>
                    </div>
                    <div>
                        <input type="hidden" name="student_number_ra" id="student_number_ra" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                <div class="card mt-2">
                    <table class="table table-sm table-hover table-bordered" id="lista">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 2rem">Turma</th>
                            <th scope="col">Nome</th>
                            <th scope="col" class="text-center" style="width: 3rem">Dia</th>
                            <th scope="col" class="text-center" style="width: 3rem">Hora</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 250% !important;">
                        @foreach($outputs as $output)
                            <tr style="background-color:#ffffff !important;">
                                <td class="text-center">{{$output->student->room->name}}</td>
                                <td>{{$output->student->name}}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($output->updated_at)->format('d')}}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($output->updated_at)->format('H:i')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="float-end">
                    {{ $outputs->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/2.0.0-rc.4/instascan.min.js"></script>--}}
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.4/howler.min.js"></script>
    <script type="text/javascript">
        // Exibe a camera na view
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});

        // Retorna o evento com a url
        scanner.addListener('scan', function (content) {
            // CSRF-Tiken Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Retorna a url completa
            string = content;
            // Retorna a url em array
            resultado = string.split('/');
            // Retorna o index 5 da url
            console.log(resultado[5]);
            $(function () {
                $.ajax({
                    url: content,
                    method: 'POST', success: function () {
                        // Atualiza a table sem dar reflesh na página
                        $('#totalStudents').load(document.URL + ' #totalStudents');
                        $('#lista').load(document.URL + ' #lista');
                    }, error: function (e) {
                        Swal.fire({
                            position: "tot-center",
                            icon: "warning",
                            title: "Procure a Gestão!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
                // Retorna o som em mp3
                let soundStore = new Howl({src: "{{asset('/sounds/beep-output.mp3')}}"});
                soundStore.play();
                // Retorna o valor do indice 5 da url para o iod do input
                document.getElementById('student_number_ra').value = resultado[5];
                // location.reload();

                // window.open(content);
                // console.log(content);

            });

        });
        // Verifica se existe uma camera
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                Swal.fire({
                    position: "tot-center",
                    icon: "warning",
                    title: "Camera não encontrada!",
                    text: "Verifique se a camera está conectada!",
                    showConfirmButton: true,
                    // timer: 1500
                });
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            Swal.fire({
                position: "tot-center",
                icon: "warning",
                title: "Camera não encontrada!",
                text: "Verifique se a camera está conectada!",
                showConfirmButton: true,
                // timer: 1500
            });
            console.error(e);
        });

    </script>
@endsection