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
    <div class="flex justify-between items-center">
        <h1 class="decor-regular text-5xl text-left my-7">Występy:</h1>

        <a wire:navigate href="/performances/create">
        <span class="text-5xl block text-orange-700 hover:scale-105 transition-transform">
                ⊕
            </span>
        </a>
    </div>

    <div>
        <h2 class="text-3xl label text-left mb-3">Przyszłe występy:</h2>
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($this->futurePerformances as $performance)
                <li class="rounded-md bg-gray-100 px-4 py-3 group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-3xl decor-regular">
                            <span class="text-orange-800">
                                🎤
                            </span>
                            <a class="group-hover:text-orange-800" href="/performances/{{ $performance->id }}"
                                wire:navigate>
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

    <hr class="text-orange-800/30 my-10">

    <div>
        <h2 class="text-3xl label text-left mb-3">Minione występy:</h2>
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($this->pastPerformances as $performance)
                <li class="rounded-md bg-gray-100 opacity-50 px-4 py-3 group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-3xl decor-regular">
                            <span class="text-orange-800">
                                🎤
                            </span>
                            <a class="group-hover:text-orange-800" href="/performances/{{ $performance->id }}"
                                wire:navigate>
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
