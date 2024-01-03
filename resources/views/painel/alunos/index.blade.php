@extends('layouts.master')

@section('content')
    @can('students.index')
        <div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Alunos: {{$alunosCount}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="card">
                                <div class="card-header pb-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            <div class="mb-2">
                                                <a href="{{route('painel.estudantes.registrar.entradas', [\Carbon\Carbon::now('America/Sao_Paulo')->monthName, \Carbon\Carbon::now('America/Sao_Paulo')->day])}}"
                                                   class="btn btn-sm btn-primary w-100" target="_blank">
                                                    Registrar Entradas
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            <div class="mb-2">
                                                <a href="{{route('painel.estudantes.listar-entradas')}}"
                                                   class="btn btn-sm btn-primary w-100">
                                                    Lista de Entradas
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            <div class="mb-2">
                                                <a href="{{route('painel.estudantes.registrar.saidas', [\Carbon\Carbon::now('America/Sao_Paulo')->monthName, \Carbon\Carbon::now('America/Sao_Paulo')->day])}}"
                                                   class="btn btn-sm btn-warning w-100" target="_blank">
                                                    Registrar Saídas
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            <div class="mb-2">
                                                <a href="{{route('painel.estudantes.listar-saidas')}}"
                                                   class="btn btn-sm btn-warning w-100">
                                                    Lista de Saídas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <form method="GET" action="{{route('painel.alunos.index')}}">
                                    <div class="input-group mb-3">
                                        <input id="title" name="searchAluno" type="search"
                                               class="form-control form-control-sm" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-outline-primary btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                                @if(isset($alunos))
                                    {!! $alunos->appends(Request::all())->links() !!}
                                @else
                                    {!! $alunos->links() !!}
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                <a href="{{route('painel.alunos.index')}}" class="btn btn-sm btn-primary w-100">Todos</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            {{--                                            <th style="width: 10rem">QR Code</th>--}}
                                            <th>Nome</th>
                                            <th style="width: 4rem">RA</th>
                                            <th style="width: 1rem">D</th>
                                            <th style="width: 5rem">Data Nasc</th>
                                            <th style="width: 3rem">Idade</th>
                                            <th style="width: 17rem">E-mail</th>
                                            <th style="width: 3rem">Status</th>
                                            <th scope="col" class="text-center" style="width: 6rem">Gerar QrCode</th>
                                            {{--                                            <th scope="col" class="text-center" style="width: 5rem">Salvar</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($alunos as $aluno)
                                            <tr>
                                                {{--                                                <td class="text-center">--}}
                                                {{--                                                    @if($aluno->qrcode != null)--}}
                                                {{--                                                        @if($aluno->qrcode != '')--}}
                                                {{--                                                            <img src="{{url('storage/images/qrcodes/'.$aluno->qrcode)}}"--}}
                                                {{--                                                                 alt="{{$aluno->name}}" class="flex-shrink-0 me-2 rounded" width="150"--}}
                                                {{--                                                                 height="150">--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                        <img src="{{$aluno->qrcode}}">--}}
                                                {{--                                                    @else--}}
                                                {{--                                                        <img id="QrCodeImage">--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                </td>--}}
                                                <td class="text-truncate">{{$aluno->name}}</td>
                                                <td class="text-truncate text-center">{{$aluno->number_ra}}</td>
                                                <td class="text-truncate text-center">{{$aluno->number_ra_digit}}</td>
                                                <td class="text-truncate text-center">
                                                    {{\Carbon\Carbon::parse($aluno->date_birth)->format('d/m/Y')}}
                                                </td>
                                                <td class="text-truncate text-center">
                                                    {{\Carbon\Carbon::parse($aluno->date_birth)->age}}
                                                </td>
                                                <td class="text-truncate">{{$aluno->email_google}}</td>
                                                <td class="text-truncate text-center">{{$aluno->student_situation}}</td>
                                                {{--                                                <td class="text-truncate text-center">--}}
                                                {{--                                                    <a href="{{route('dashboard.alunos.gerar.qrcode',$aluno->number_ra)}}"--}}
                                                {{--                                                       target="_blank" class="btn btn-sm btn-warning">--}}
                                                {{--                                                        qrcode--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                </td>--}}
                                                <td class="text-truncate text-center">
                                                        <a href="{{route('painel.alunos.gerar.qrcode.aluno.pdf', $aluno->number_ra)}}"
                                                           target="_blank">
                                                            <button type="button" class="btn btn-sm btn-secondary w-100">
                                                                Imprimir
                                                            </button>
                                                        </a>
                                                </td>
                                                {{--                                                <td class="text-truncate text-center">--}}
                                                {{--                                                    <input type="hidden" id="aluno"--}}
                                                {{--                                                           value="{{'/painel/estudantes/cadastrar/qrcode/'.$aluno->number_ra}}">--}}
                                                {{--                                                    @if($aluno->qrcode == null)--}}
                                                {{--                                                        <button onclick="gerarQrCode()" class="btn btn-sm btn-warning">Gerar</button>--}}
                                                {{--                                                    @else--}}
                                                {{--                                                        <button onclick="gerarQrCode()" class="btn btn-sm btn-warning" disabled>Gerar</button>--}}
                                                {{--                                                    @endif--}}

                                                {{--                                                </td>--}}
                                                {{--                                                <td class="text-truncate">--}}
                                                {{--                                                    <form action="{{route('painel.estudantes.cadastrar.gerarQrcodeAluno')}}" method="POST"--}}
                                                {{--                                                          enctype="multipart/form-data">--}}
                                                {{--                                                        @csrf--}}
                                                {{--                                                        <input type="hidden" name="id" value="{{$aluno->id}}">--}}
                                                {{--                                                        <input type="hidden" name="name" value="{{$aluno->name}}">--}}
                                                {{--                                                        <input type="hidden" name="number_ra" value="{{$aluno->number_ra}}">--}}
                                                {{--                                                        <input id="qrcode" type="hidden" name="qrcode" value="">--}}
                                                {{--                                                        <input id="qrcodefile" type="file" name="file" value="QrCodeImage">--}}
                                                {{--                                                        @if($aluno->qrcode == null)--}}
                                                {{--                                                            <button type="submit" class="btn btn-sm btn-success">Salvar</button>--}}
                                                {{--                                                        @else--}}
                                                {{--                                                            <button type="submit" class="btn btn-sm btn-success" disabled>Salvar</button>--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                    </form>--}}
                                                {{--                                                </td>--}}
                                            </tr>
                                        @empty
                                            <h6>Nenhum registro até o momento!</h6>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@push('scripts')
    <script>
        function gerarQrCode() {
            let inputAluno = document.getElementById("aluno").value;
            let googleChartApi = 'https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=';
            let UrlQrCode = googleChartApi + inputAluno;
            document.querySelector('#QrCodeImage').src = UrlQrCode;
            // document.getElementById('dataImage').value = canvas.toDataURL("image/png");
            document.getElementById("qrcode").value = UrlQrCode;
            // document.getElementById("qrcodefile").value = UrlQrCode;

            // const fileInput = document.querySelector('input[type="file"]');
            // const myFile = new File([UrlQrCode], UrlQrCode, {
            //     type: 'png',
            //     lastModified: new Date(),
            // });
            // const dataTransfer = new DataTransfer();
            // dataTransfer.items.add(myFile);
            // fileInput.files = dataTransfer.files;
        }
    </script>
@endpush