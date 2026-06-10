@extends('layouts.app', ['title' => 'Śpiewnik - Zmiana hasła'])

@section('content')
    <div class="flex h-[70vh] items-center justify-center">

        <div class="flex flex-col items-center space-y-10 rounded-md bg-gray-100 p-10 shadow-xl">
            <h1 class="decor-regular py-5 text-5xl text-orange-800">
                <span>🔑</span>&nbsp;
                Ustaw nowe hasło
            </h1>
            <form
                class="max-w-100 flex w-full flex-col gap-5"
                action="{{ route('reset-password') }}"
                method="POST"
            >
                @csrf
                <input
                    class="input"
                    type="email"
                    value="{{ Request::query('email') }}"
                    name="email"
                    id="email"
                    placeholder="jan.kowalski@gmail.com"
                >
                <input
                    class="input"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Twoje hasło..."
                >
                <input
                    class="input"
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Powtórz hasło..."
                >
                <input
                    class="input hidden"
                    type="text"
                    name="token"
                    value="{{ Request::query('token') }}"
                    id="token"
                    placeholder="token..."
                >

                <x-errors-panel />

                <button class="button mx-auto">Ustaw hasło</button>
            </form>
        </div>

    </div>
@endsection
