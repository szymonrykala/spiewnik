<?php

use Livewire\Component;

new class extends Component
{
    public string $password = '';
    public string $email = '';

    public function handle_login(){
        return $this->redirect('/');
    }
};
?>

<div class="flex flex-col gap-15 justify-center mx-auto mt-[15vh] max-w-fit">
    <h1 class="text-7xl text-orange-950 decor-regular">Witaj w śpiewniku ♬</h1>

    <form
        wire:submit="handle_login"
    class="flex flex-col gap-3 bg-white p-4 shadow-lg rounded-md w-80 mx-auto"
     >
        <h2 class="text-center text-4xl my-4 decor-regular">Zaloguj się</h2>
        <input type="email" wire:model="email" class="input" placeholder="Twój email">
        <input type="password" wire:model="password" class="input"  placeholder="Wpisz hasło">

        <button type="submit" class="button mx-auto">Zaloguj</button>
    </form>
</div>
