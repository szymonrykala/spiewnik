<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Performance;

new class extends Component {
    public bool $showCreateModal = false;

    #[Computed]
    public function futurePerformances()
    {
        return Performance::where('performance_date', '>', now())->orderBy('performance_date', 'asc')->simplePaginate(3);
    }

    #[Computed]
    public function pastPerformances()
    {
        return Performance::where('performance_date', '<', now())->orderBy('performance_date', 'desc')->simplePaginate(12);
    }
};
?>

<div class="container flex flex-col">
    <div class="flex items-center justify-between">
        <h1 class="decor-regular my-7 text-left text-5xl">Występy:</h1>
    </div>

    <div>
        <h2 class="label mb-3 flex items-center justify-between text-left text-3xl">
            <span>
                Przyszłe występy:
            </span>
            @admin
                <a
                    wire:navigate
                    href="/performances/create"
                >
                    <span class="block text-4xl text-orange-700 transition-transform hover:scale-105">
                        ⊕
                    </span>
                </a>
            @endadmin
        </h2>
        <ul class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->futurePerformances as $performance)
                <li class="group rounded-md bg-gray-100 px-4 py-3">
                    <div class="flex flex-col gap-1">
                        <h3 class="decor-regular text-3xl">
                            <span class="text-orange-800">
                                🎤
                            </span>
                            <a
                                class="group-hover:text-orange-800"
                                href="/performances/{{ $performance->id }}"
                                wire:navigate
                            >
                                {{ $performance->name }}
                            </a>
                        </h3>
                        <span class="font-semibold text-orange-800">{{ $performance->performance_date }}</span>
                        <p class="line-clamp-2 text-orange-950/70">
                            {{ \Illuminate\Support\Str::limit(strip_tags($performance->description), 300) }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="">
            {{ $this->futurePerformances->links() }}
        </div>
    </div>

    <hr class="my-10 text-orange-800/30">

    <div>
        <h2 class="label mb-3 text-left text-3xl">Minione występy:</h2>
        <ul class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->pastPerformances as $performance)
                <li class="group rounded-md bg-gray-100 px-4 py-3 opacity-50">
                    <div class="flex flex-col gap-1">
                        <h3 class="decor-regular text-3xl">
                            <span class="text-orange-800">
                                🎤
                            </span>
                            <a
                                class="group-hover:text-orange-800"
                                href="/performances/{{ $performance->id }}"
                                wire:navigate
                            >
                                {{ $performance->name }}
                            </a>
                        </h3>
                        <span class="font-semibold text-orange-800">{{ $performance->performance_date }}</span>
                        <p class="line-clamp-2 text-orange-950/70">
                            {{ \Illuminate\Support\Str::limit(strip_tags($performance->description), 300) }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="">
            {{ $this->futurePerformances->links() }}
        </div>
    </div>

</div>
