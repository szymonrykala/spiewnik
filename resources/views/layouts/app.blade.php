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

<body class="w-full flex flex-col px-3 text-orange-950 bg-gray-200 items-stretch justify-between min-h-screen">

    <div class="flex justify-between container mx-auto items-center">
        <div class="flex items-center p-2 py-3 gap-2 text-2xl decor-regular">
            <span class="text-5xl text-orange-700">♬</span>
            Śpiewnik
        </div>

        <div></div>
    </div>

    <livewire-navigation />

    <main class="p-3 grow">
        {{ $slot }}
    </main>

    @livewireScripts
    <x-footer />
</body>

</html>
