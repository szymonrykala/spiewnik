<article class="container mx-auto max-w-2xl relative">

    @if ($lastGeneratedLink)
        <div class="bg-gray-200/70 w-lvw h-lvh fixed top-0 left-0 flex flex-col justify-center items-center">

            <div
                class="relative space-y-3 p-8 text-xl shadow-xl -translate-y-15 bg-gray-100 rounded-md w-full max-w-100">
                <span wire:click="closeLinkWindow" class="absolute top-2 right-2 cursor-pointer">❌</span>

                <h2 class="text-4xl decor-regular text-regular-800">Link do resetu hasła</h2>
                <p>Zapisz link i wyślij użytkownikowi</p>
                <p>
                    <a class="text-orange-700 hover:text-orange-600" href="{{ $lastGeneratedLink ?? '' }}">
                        🔗 skopiuj ten link
                    </a>
                </p>
            </div>

        </div>
    @endif


    <div class="bg-gray-100 p-5 rounded-md shadow-md space-y-10">
        <h2 class="text-3xl">Zarządzanie użytkownikami</h2>

        <div>
            <form class="flex flex-col gap-3 max-w-80" wire:submit="createUser">
                <input type="email" class="input" wire:model="newUser.email" name="user-email" id="user-email"  placeholder="Podaj email">
                <input type="text" class="input" wire:model="newUser.name" name="user-name" id="user-name"  placeholder="Imię...">
                <label for="is-admin">
                    <input type="checkbox" class="input" name="is-admin" wire:model="newUser.isAdmin" id="is-admin">
                    Uprawnienia administratora
                </label>
                <button type="submit" class="button">Dodaj użytkownika</button>
            </form>
        </div>

        <table class="table-auto divide-y divide-gray-200">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Zmiana hasła</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody class="divide-gray-20">
                @foreach ($this->allUsers as $user)
                    <tr class="hover:bg-gray-100 transition-colors p-3">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">{{ $user->is_admin?'✅':'Ｘ' }}</td>
                        <td class="p-2">
                            @if ($user->passwordReset)
                                @php
                                    $restLink = route('reset-password') . '?token=' . $user->passwordReset->token;
                                @endphp
                                <a href="{{ $restLink }}" class="hover:text-orange-600">
                                    🔗 link do resetu hasła
                                </a>
                                &nbsp;
                                <button wire:click="generateUpdatePasswordLink({{ $user->id }})"
                                    class="cursor-pointer">
                                    🔄
                                </button>
                            @else
                                <button wire:click="generateUpdatePasswordLink({{ $user->id }})" class="button">
                                    Nowy link
                                </button>
                            @endif
                        </td>
                        <td class="p-2">
                            <div>
                                <button wire:click="removeUser({{ $user->id }})" class="button">Usuń</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</article>
