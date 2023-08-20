<!DOCTYPE html>
<html data-theme="cmyk" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

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

    @yield('content')

    @stack('modals')

    @livewireScripts
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>
