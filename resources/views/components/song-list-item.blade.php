@props(['song', 'activeTags', 'performanceId' => null, 'assignToPerformance' => null, 'removeAssignment' => null])

@php
    if ($removeAssignment) {
        $itemStyle = 'bg-green-500/5 border-3 border-green-500/20';
    } elseif ($performanceId) {
        $itemStyle = 'bg-gray-100/70 hover:bg-gray-100';
    } else {
        $itemStyle = 'bg-gray-100/70 hover:bg-gray-100';
    }
@endphp

<li
    wire:key="song-{{ $song->id }}"
    wire:transition
    class="{{ $itemStyle }} group relative rounded-md px-2 py-2 transition-colors md:px-4 md:py-3"
    wire:transition
>

    {{-- @if ($performanceId && $assignToPerformance)
        <button
            title="Dodaj do występu"
            wire:click="{{ $assignToPerformance }}"
            class="absolute right-1 top-1 cursor-pointer text-4xl text-green-600 hover:scale-110 group-hover:block"
        >
            ⊕
        </button>
    @elseif($removeAssignment)
        <button
            title="Usuń z występu"
            wire:click="{{ $removeAssignment }}"
            class="absolute right-1 top-1 cursor-pointer text-4xl text-red-600 hover:scale-110 group-hover:block"
        >
            ⊖
        </button>
    @endif --}}

    <div class="flex items-stretch gap-1">
        <div class="flex flex-col gap-1 overflow-hidden">
            <h3 class="flex items-center gap-1 text-lg">
                <span class="text-orange-800">
                    ♫
                </span>
                <a
                    class="w-full font-semibold text-orange-900 group-hover:text-orange-700"
                    href="/songs/{{ $song->id }}"
                    wire:navigate
                >
                    {{ $song->title }}
                </a>
            </h3>

            <p class="line-clamp-1 text-sm text-orange-950/70">
                {{ \Illuminate\Support\Str::limit(strip_tags($song->lyrics), 300) }}
            </p>

            <div class="scrollbar-none flex gap-2 overflow-scroll text-sm">
                @foreach ($song->tags as $tag)
                    <div class="tag tag--secondary {{ in_array($tag->name, $activeTags) ? 'tag--active' : '' }}">
                        {{ $tag->name }}
                    </div>
                @endforeach
            </div>
        </div>
        @if ($performanceId && $assignToPerformance)
            <div class="flex rounded-md bg-green-200/30 p-1 md:p-2">
                <button
                    title="Dodaj do występu"
                    wire:click="{{ $assignToPerformance }}"
                    class="cursor-pointer text-4xl text-green-500 hover:scale-110"
                >
                    ⊕
                </button>
            </div>
        @elseif($removeAssignment)
            <div class="flex rounded-md bg-red-200/30 p-1 md:p-2">
                <button
                    title="Usuń z występu"
                    wire:click="{{ $removeAssignment }}"
                    class="cursor-pointer text-4xl text-red-500 hover:scale-110 group-hover:block"
                >
                    ⊖
                </button>
            </div>
        @endif
    </div>
</li>
