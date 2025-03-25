<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ismael_Delgado_Projecte UF3 @yield('title')</title>
    @section('stylesheets')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @show
</head>

<body class="bg-gray-950">
    @include('navbar')
    <div class="w-full">
        @yield('content')
    </div>
</body>

</html>