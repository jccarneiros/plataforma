@extends('layouts.qrcode')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($room->students as $student)
                <div class="card rounded-0 pb-3"
                     style="width: 14.5rem !important;height:19rem!important;margin-bottom: 4.5rem!important;">
                    <div class="card rounded-0" style="width:14.5rem;font-size:90%!important;border: 1px solid #cccccc;box-shadow: none !important;">
                        <h6 class="card-title text-center pt-3 mb-1 text-uppercase" style="font-size: 80% !important;">E. E. {{$siteInfo->app_name}}</h6>
                        <span class="text-center" style="font-size: 75% !important;">{{$siteInfo->app_endereco}} , {{$siteInfo->app_numero}} - {{$siteInfo->app_bairro}} - {{$siteInfo->app_cidade}}</span>
                        <div class="text-center" style="margin: 0!important;padding: 0!important;">
                            {!! QrCode::size(150)->generate("/dashboard/students/cadastrar/qrcode/{$student->number_ra}") !!}
                        </div>
                        <div class="text-center">
                            <div style="font-size: 85% !important;">{{$student->name}}</div>
                            <div style="font-size: 70% !important;">{{$student->email_microsoft}}</div>
                            <div style="font-size: 75% !important;">{{$student->email_google}}</div>
                            <div style="font-size: 100% !important;">RA: {{$student->number_ra}} / Dígito: {{$student->number_ra_digit}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
