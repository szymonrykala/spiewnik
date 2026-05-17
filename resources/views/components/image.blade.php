@props(['src', 'alt', 'class' => 'w-full h-auto rounded-xl cursor-pointer'])

<div x-data="{ open: false, image: '{{ $src }}' }" class="relative">
    <img src="{{ $src }}" alt="{{ $alt }}" class="{{$class}}" @click="open = true">

    <!-- Fullscreen Modal -->
    <div x-show="open" class="fixed inset-0 bg-black/90 z-[9999] flex items-center justify-center p-4"
        @click.self="open = false" x-transition>
        <div class="relative max-w-7xl max-h-[95vh] flex items-center justify-center">
            <!-- Przycisk zamknięcia -->
            <button @click="open = false"
                class="absolute -top-4 -right-4 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-full p-3 shadow-lg hover:scale-110 transition-transform z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6h12v12" />
                </svg>
            </button>

            <img :src="image" :alt="alt"
                class="max-h-[90vh] max-w-full object-contain rounded-2xl shadow-2xl" @click.stop>
        </div>

        <!-- Podpowiedź -->
        <div class="absolute bottom-6 text-white/70 text-sm">
            Kliknij poza obrazem lub ESC, aby zamknąć
        </div>
    </div>
</div>
