<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        <?php include(public_path() . '/assets/css/bootstrap3.min.css'); ?>
        .page-break {
            page-break-after: always;
        }
    </style>
    <title>Lista de QrCode da turma: {{$room->name}}</title>
</head>
<body>
<div class="container-fluid" style="margin-top: -2rem !important;margin-left: -6% !important;">
    Lista de QrCode da turma: {{$room->name}} / impressa em: {{\Carbon\Carbon::now()->format('d/m/Y')}} / por: {{auth()->user()->name}}
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(0,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(4,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(8,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(12,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="page-break"></div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(16,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(20,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(24,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(28,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="page-break"></div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(32,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(36,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(40,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(44,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="page-break"></div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(48,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(52,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(56,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
        @foreach($students->slice(60,4) as $student)
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$student->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($student->name)}} {{middleName($student->name)}} {{lastName($student->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$student->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$student->number_ra}} /
                    Dígito: {{$student->number_ra_digit}}</div>
            </div>
        @endforeach
    </div>
</div>
<div class="page-break"></div>
</body>
</html>
