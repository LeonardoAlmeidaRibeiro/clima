<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#087f53">
    <meta name="description" content="Clima na Pele: painel de gestão de ocorrências ambientais, prioridades e ações públicas.">
    <title>Painel do gestor · Clima na Pele</title>
    <link rel="icon" href="{{ asset('images/brand.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('vendor/metronic/plugins/global/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/metronic/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v=metronic-1">
</head>
<body id="kt_body" class="clima-app">
@yield('content')
    <script src="{{ asset('vendor/metronic/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('vendor/metronic/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}?v=metronic-1"></script>

</body>
</html>
