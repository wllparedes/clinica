<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Clinica </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/clinic/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @stack('css')

    <!-- Wire UI -->
    <wireui:scripts />

</head>

<body class="font-onest-variable antialiased">
    <x-banner />

    <div class="grid-container">

        @include('clinic.common.partials.sidebar')

        <div class="min-h-screen bg-white main-container">

            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <x-notifications />

                {{ $slot }}
            </main>

            @include('clinic.common.partials.footer')

        </div>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

</body>

</html>
