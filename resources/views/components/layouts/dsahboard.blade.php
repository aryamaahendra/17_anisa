<!DOCTYPE html>
<html data-theme="" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:300,300i,400,700,900" rel="stylesheet" />

    @livewireStyles
    @vite(['resources/css/app.css'])
</head>

<body class="antialiased bg-base-200">
    <div class="drawer lg:drawer-open">
        <input id="sidebar" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col px-6 py-4 gap-6">
            @include('components.layouts.dashboard.navbar')

            <main class="flex-">
                @yield('content')
            </main>

        </div>
        @include('components.layouts.dashboard.sidebar')
    </div>

    @stack('modals')

    @livewireScripts
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>
