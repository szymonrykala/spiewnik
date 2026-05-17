<?php
use Livewire\Component;

new class extends Component {};
?>


<?php
$nav_item = 'rounded-xl px-4 py-2 hover:bg-orange-700/10 transition-colors group';
$nav_item_a = 'flex flex-col items-center';
$nav_item_svg = 'fill-orange-700 group-hover:scale-115 transition-transform';
?>

<nav class="fixed bottom-5 right-5 z-50">

    <ul class="bg-gray-100 flex gap-1 rounded-xl p-1 shadow-2xl border-orange-900/10">

        <li class="{{ $nav_item }}">
            <a href="/performances" wire:navigate class="{{ $nav_item_a }}">
                <span class="text-3xl">🎤</span>
                <span class="text-xs">
                    Występy
                </span>
            </a>
        </li>
        <li class="{{ $nav_item }}">
            <a href="/songs" wire:navigate class="{{ $nav_item_a }}">
                <span class="text-3xl">🔎</span>
                <span class="text-xs">
                    Piosenki
                </span>
            </a>
        </li>
        {{-- <li class="{{ $nav_item }}">
            <a href="/logout" wire:navigate class="{{ $nav_item_a }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    class="{{ $nav_item_svg }}">
                    <path
                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                </svg>
                <span class="text-xs">
                    wyloguj
                </span>
            </a>
        </li> --}}
    </ul>

</nav>
