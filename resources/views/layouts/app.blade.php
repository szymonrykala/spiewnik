<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')

    @livewireStyles
</head>

<body class="w-full flex flex-col px-3 text-orange-950 bg-gray-100 items-stretch justify-between min-h-screen">
    <x-navigation />

    <main class="p-3 grow">
        {{ $slot }}
    </main>

    @livewireScripts
    <x-footer />
</body>

</html>
