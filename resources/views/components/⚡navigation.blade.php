<?php
use Livewire\Component;

new class extends Component {};
?>


<?php
$nav_item = 'rounded-xl px-3 md:px-4 py-2 hover:bg-gray-200/80 bg-gray-200/50 transition-colors group';
$nav_item_a = 'flex flex-col items-center';
$nav_item_svg = 'fill-orange-700 group-hover:scale-115 transition-transform';
?>

<nav class="fixed bottom-1 right-1 z-50 md:bottom-5 md:right-5">
    @auth
        <ul class="flex gap-1 rounded-xl border-orange-900/10 bg-gray-100 p-1 shadow-2xl">
            @admin
                <li class="{{ $nav_item }}">
                    <a
                        href="/settings"
                        wire:navigate
                        class="{{ $nav_item_a }}"
                    >
                        <span class="text-2xl md:text-3xl">⚙️</span>
                        <span class="text-xs">
                            Ustawienia
                        </span>
                    </a>
                </li>
            @endadmin
            <li class="{{ $nav_item }}">
                <a
                    href="/performances"
                    wire:navigate
                    class="{{ $nav_item_a }}"
                >
                    <span class="text-2xl md:text-3xl"">🎤</span>
                    <span class="text-xs">
                        Występy
                    </span>
                </a>
            </li>
            <li class="{{ $nav_item }}">
                <a
                    href="/songs"
                    wire:navigate
                    class="{{ $nav_item_a }}"
                >
                    <span class="text-2xl md:text-3xl"">🔎</span>
                    <span class="text-xs">
                        Piosenki
                    </span>
                </a>
            </li>
        </ul>
    @endauth
</nav>
