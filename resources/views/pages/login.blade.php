@extends('layouts.app', ['title' => 'Śpiewnik - logowanie'])

@section('content')
    <div class="flex justify-center items-center h-[70vh]">

        <div class="space-y-10 flex flex-col items-center bg-gray-100 rounded-md shadow-xl p-10">
            <h1 class="flex flex-col items-center md:block text-5xl py-5 text-orange-800 decor-regular">
                <span>🎼</span>&nbsp;
                Zaloguj się!
            </h1>
            <form class=" flex flex-col gap-5 max-w-100 w-full" action="/login" method="POST">
                @csrf
                <input class="input" type="email" name="email" id="email" placeholder="jan.kowalski@gmail.com">
                <input class="input" type="password" name="password" id="password" placeholder="Twoje hasło...">

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember" class="ml-2">
                        Zapamiętaj mnie
                    </label>
                </div>

                <x-errors-panel />

                <button class="button mx-auto">Zaloguj</button>
            </form>
        </div>

    </div>
@endsection
