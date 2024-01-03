<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{--    <link rel="stylesheet" href="{{asset('assets/css/custom-bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/custom-controls.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/title.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sidebar.css')}}">

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('styles')
    <!-- Scripts -->
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

</head>
<body>
@yield('content')


@include('sweetalert::alert')
@stack('scripts')
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
<script>
    //display flyout mobile-menu
    $('.nav__toggle').on('click', function () {
        $('.nav, .mobile-mask').toggleClass('show');
    });

    $('.mobile-mask').on('click', function () {
        $('.nav, .mobile-mask').removeClass('show');
    });
</script>
<script>
    // window.onload = function () {
    //     document.oncontextmenu = function () {
    //         Swal.fire('Função desabilitada!');
    //         return false;
    //     }
    // }
</script>
<!-- Hidden Message Script -->
<script type="text/javascript">
    window.setTimeout(function () {
        $(".text-hidden").fadeTo(2000, 0).slideUp(500, function () {
            $(this).hide();
        });
    }, 1500);
</script>
{{--<script type="text/javascript">--}}
{{--    window.setTimeout(function () {--}}
{{--        $(".alert").fadeTo(2000, 0).slideUp(500, function () {--}}
{{--            $(this).hide();--}}
{{--        });--}}
{{--    }, 1500);--}}
{{--</script>--}}
</body>
</html>
