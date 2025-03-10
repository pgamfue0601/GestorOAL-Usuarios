<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="oal.ico" type="image/x-icon">

        <title inertia>{{ config('app.name', 'Gestor-OAL') }}</title>

        

        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx", 'resources/sass/app.scss', 'resources/sass/dashboard.scss'])
        @inertiaHead
    </head>
    <body class="">
        @inertia
    </body>
</html>
