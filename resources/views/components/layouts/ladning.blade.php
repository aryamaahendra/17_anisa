<!DOCTYPE html>
<html data-theme="mytheme" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>K-Beras</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:300,300i,400,700,900" rel="stylesheet" />

    @livewireStyles
    @vite(['resources/css/app.css'])
</head>

<body class="antialiased bg-base-200 min-h-screen min-w-screen">
    @if (session()->has('flash-messages'))
        <input type="hidden" id="flash-message-error"
            value="{{ session('flash-messages')['error'] }}">
        <input type="hidden" id="flash-message-message"
            value="{{ session('flash-messages')['message'] }}">
    @endif

    <div class="bg-base-100 shadow">
        <div class="navbar max-w-5xl mx-auto">
            <div class="flex-1">
                <a class="btn btn-ghost hover:bg-base-100 normal-case text-xl">
                    <img src="{{ asset('logo.png') }}" class="w-full h-full" alt="logo">
                </a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal space-x-1 px-1">
                    <li><a href="{{ route('landing.index') }}">Home</a></li>
                    <li><a href="{{ route('landing.about') }}">About</a></li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="btn-primary hover:text-primary-content hover:bg-primary">
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    @stack('modals')

    @livewireScripts
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>
