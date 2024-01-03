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
    <title>QrCode @do Aluno: {{$aluno->name}}</title>
</head>
<body>
<div class="container-fluid" style="margin-left: -6% !important;">
    <div class="row" style="margin: 0 !important;padding: 0 !important;text-align: center">
            <div class="col-xs-3" style="margin: 0 !important;padding: 0 0.4rem 0.5rem 0.4rem !important;border:solid #cccccc;">
                <div class="text-center pt-3 text-uppercase" style="font-size: 70% !important;">E. E. {{$siteInfo->app_name}}</div>
                <div class="text-center" style="font-size: 80% !important;">{{$siteInfo->app_endereco}}, {{$siteInfo->app_numero}}</div>
                <div class="text-center"
                     style="font-size: 80% !important;margin: 0!important;padding: 0!important;">{{$siteInfo->app_bairro}}
                    - {{$siteInfo->app_cidade}}</div>
                <div class="text-center" style="margin: 0 !important;padding: 0 !important;">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{{$aluno->number_ra}}">
                </div>
                <div class="text-center" style="font-size: 80% !important;margin: 0 !important;padding: 0!important;">
                    {{firstName($aluno->name)}} {{middleName($aluno->name)}} {{lastName($aluno->name)}}
                </div>
                <div class="text-center" style="font-size: 65% !important;margin: 0 !important;padding: 0!important;">
                    {{$aluno->email_google}}
                </div>
                <div style="font-size: 80% !important;margin: 0 !important;">RA:{{$aluno->number_ra}} /
                    Dígito: {{$aluno->number_ra_digit}}</div>
            </div>
    </div>
</div>
</body>
</html>