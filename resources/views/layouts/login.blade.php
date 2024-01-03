<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <title>Login</title>
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="main-login mt-5">

   @yield('content')
</div>
@include('sweetalert::alert')
<script>
    function toggleFloatAnimation(element) {
        element.classList.toggle("float-animation");
    }
</script>
</body>
</html>
