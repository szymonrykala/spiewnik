@extends('layouts.app', ['title' => 'Śpiewnik - Zmiana hasła'])

@section('content')
    <div class="flex justify-center items-center h-[70vh]">

        <div class="space-y-10 flex flex-col items-center bg-gray-100 rounded-md shadow-xl p-10">
            <h1 class="text-5xl py-5 text-orange-800 decor-regular">
                <span>🔑</span>&nbsp;
                Ustaw nowe hasło
            </h1>
            <form class=" flex flex-col gap-5 max-w-100 w-full" action="{{ route('reset-password') }}" method="POST">
                @csrf
                <input class="input" type="email" value="{{ old('email') }}" name="email" id="email"
                    placeholder="jan.kowalski@gmail.com">
                <input class="input" type="password" name="password" id="password" placeholder="Twoje hasło...">
                <input class="input" type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Powtórz hasło...">
                <input class="input" type="text" name="token" value="{{ Request::query('token') }}" id="token"
                    placeholder="token...">

                <x-errors-panel />

                <button class="button mx-auto">Ustaw hasło</button>
            </form>
        </div>

    </div>
@endsection
