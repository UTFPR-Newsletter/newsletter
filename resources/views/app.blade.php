<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead

        <link
            rel="stylesheet"
            href="{{ asset('css/font-awesome-pro-master.min.css') }}?v=0.0.1"
        >
    </head>
    <body class="antialiased">
        @inertia
    </body>
</html>
