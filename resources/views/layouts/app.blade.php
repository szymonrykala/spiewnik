<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')

    @livewireStyles
</head>

<body class="flex min-h-screen w-full flex-col items-stretch justify-between bg-gray-200 p-1 text-orange-950 md:p-3">

    <div class="container mx-auto flex items-center justify-between">
        <div class="decor-regular flex items-center gap-2 p-2 py-3 text-2xl">
            <span class="text-5xl text-orange-700">♬</span>
            Śpiewnik Szymona
        </div>

        <div>
            @if (Auth::check())
                <a href="{{ route('logout') }}">
                    <span class="cursor-pointer px-1 text-3xl text-orange-700/50">
                        🚀
                    </span>
                </a>
            @endif
        </div>
    </div>

    <livewire-navigation />

    <main class="grow p-3">
        @if (isset($slot))
            {{ $slot }}
        @endif
        @yield('content')
    </main>

    @livewireScripts
    <x-footer />
</body>

</html>
