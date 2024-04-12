<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Admin | Clinica </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/clinic/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Flowbite -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" /> --}}

    <!-- Wire UI -->
    <wireui:scripts />

</head>

<body class="font-onest-variable antialiased">

    <x-dialog />

    <x-banner />

    <div class="grid-container">

        @include('admin.common.partials.sidebar')

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

            @include('admin.common.partials.footer')

        </div>
    </div>

    @stack('modals')

    @livewireScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
