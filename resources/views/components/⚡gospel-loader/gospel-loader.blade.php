<div class="space-y-1">
    <button wire:click="loadAllGospelReadings"
        class="button mt-6 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-xl text-sm">
        Załaduj czytania
    </button>

    @if ($loading)
        <p class="text-gray-500">Pobieram czytania liturgiczne...</p>
    @endif

    @if ($reading1 || $reading2 || $gospel)
        <div class="space-y-5 bg-gray-100 shadow-md p-5 rounded-md">
            @if ($error)
                <p class="text-red-500">{{ $error }}</p>
            @endif

            @foreach ([$reading1, $reading2, $gospel] as $reading)
                @if ($reading)
                    <div>{!! $reading !!}</div>
                @endif
            @endforeach
        </div>
    @endif
</div>
