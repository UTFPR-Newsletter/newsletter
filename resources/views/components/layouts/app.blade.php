<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WebNews</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link
            rel="stylesheet"
            href="{{ asset('css/font-awesome-pro-master.min.css') }}?v=0.0.1"
        >
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="64x64">

        <tallstackui:script />
        @livewireStyles
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <x-ts-dialog />
        <x-ts-toast />

        {{ $slot }}

        @livewireScripts
        @vite('resources/js/app.js')
    </body>
</html>
