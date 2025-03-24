<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ismael_Delgado_Projecte UF3 @yield('title')</title>
    @section('stylesheets')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @show
</head>

<body class="bg-gray-950">
    @include('navbar')
    <div class="container">
        @yield('content')
    </div>
</body>

</html>