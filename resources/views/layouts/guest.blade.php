<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap">

    @livewireStyles

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100" style="font-family: 'Montserrat', sans-serif;">

    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    <div class="mt-10 mb-4 text-center w-1/2 mx-auto" style="font-size: 0.6rem;">
        <p class="mb-1">
            Prototipo de sistema web de gestión para la automatización de citas y solicitudes de los
            egresados para el departamento de Secretaría General de la Universidad Nacional
            Experimental Politécnica de la Fuerza Armada Nacional Bolivariana (UNEFA).
            - Trabajo Especial de Grado, presentado como requisito parcial, para optar al título de Ingeniero de sistemas.
        </p>
        <div class="flex justify-center gap-4">
            <p>
                Autor:
                <strong>Andrés Asdrúbal Alizo Arcila</strong> <br>C.I. V-27.282.294
            </p>
            <p>
                Autor:
                <strong>Joel José Márquez Torres</strong> <br> C.I. V-26.724.008
            </p>
            <p>
                Tutor:
                <strong>Ing. Ángel Gabriel Maxwell</strong>
            </p>
        </div>

    </div>

    @stack('modals')
    @stack('scripts')

    @livewireScripts
    @livewire('notifications')

</body>

</html>