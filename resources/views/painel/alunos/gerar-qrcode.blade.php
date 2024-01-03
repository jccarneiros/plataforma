@extends('layouts.qrcode')

@section('content')
    {{--    @php(phpinfo())--}}
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <div class="col-md-6 offset-md-3">
                    <div class="card rounded-0" style="width:14.5rem;font-size:90%!important;border: 1px solid #cccccc;box-shadow: none !important;">
                        <h6 class="card-title text-center pt-3 mb-1 text-uppercase" style="font-size: 80% !important;">E.
                            E. {{$siteInfo->app_name}}</h6>
                        <span class="text-center" style="font-size: 75% !important;">{{$siteInfo->app_endereco}} , {{$siteInfo->app_numero}} - {{$siteInfo->app_bairro}} - {{$siteInfo->app_cidade}}</span>
                        {{--                        <div class="text-center">{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div>--}}

                        <input type="text" name="dataImage" id="dataImage"  class="form-control form-control-sm">
                        <button onchange="showData()">Gerar</button>
                        <form action="{{route('dashboard.students.save.qrcode.image', $aluno->number_ra)}}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <input type="text" name="number_ra" value="{{$aluno->number_ra}}">
                            <input type="text" name="qrcode" id="qrcode" value=""  class="form-control form-control-sm getQrcode">

                            <button type="submit">Enviar</button>
                        </form>
                        <div class="text-center svg">{!! $qrcode !!}
                            {{--                            {!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}--}}
                        </div>
                        <div class="text-center">
                            <div style="font-size: 85% !important;">{{$aluno->name}}</div>
                            <div style="font-size: 70% !important;">{{$aluno->email_microsoft}}</div>
                            <div style="font-size: 75% !important;">{{$aluno->email_google}}</div>
                            <div style="font-size: 100% !important;">RA: {{$aluno->number_ra}} / Dígito: {{$aluno->number_ra_digit}}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var svg = document.querySelector( "svg" );
        var svgData = new XMLSerializer().serializeToString( svg );

        var canvas = document.createElement( "canvas" );
        var ctx = canvas.getContext( "2d" );

        var img = document.createElement( "img" );
        img.setAttribute( "src", "data:image/svg+xml;base64," + btoa( svgData ) );

        img.onload = function() {
            ctx.drawImage( img, 0, 0 );

            // Now is done
            console.log( canvas.toDataURL( "image/png" ) );
            // document.getElementById('dataImage').value = canvas.toDataURL("image/png");
            document.getElementById("qrcode").value = canvas.toDataURL("image/png");
        };
    </script>
@endpush
