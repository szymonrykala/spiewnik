<?php

use Livewire\Component;
use App\Models\Performance;

new class extends Component {
    public bool $showModal = false;

    public string $name = '';
    public string $description = '';
    public ?string $performance_date = null;

    public function mount()
    {
        $this->performance_date = now()->format('Y-m-d\TH:i');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'performance_date' => 'required|date',
        ]);

        $performance = Performance::create([
            'name' => $this->name,
            'description' => $this->description,
            'performance_date' => $this->performance_date,
        ]);
        $this->reset();

        $this->showModal = false;
        $this->dispatch('performanceCreated', $performance->id);
    }
};

?>


<div>
    <button x-on:click="$wire.showModal = true"
        class="rounded-md cursor-pointer bg-gray-200 size-fit p-2 hover:bg-gray-300/80">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"
            class="fill-orange-700/70">
            <path
                d="M448.67-280h66.66v-164H680v-66.67H515.33V-680h-66.66v169.33H280V-444h168.67v164Zm31.51 200q-82.83 0-155.67-31.5-72.84-31.5-127.18-85.83Q143-251.67 111.5-324.56T80-480.33q0-82.88 31.5-155.78Q143-709 197.33-763q54.34-54 127.23-85.5T480.33-880q82.88 0 155.78 31.5Q709-817 763-763t85.5 127Q880-563 880-480.18q0 82.83-31.5 155.67Q817-251.67 763-197.46q-54 54.21-127 85.84Q563-80 480.18-80Zm.15-66.67q139 0 236-97.33t97-236.33q0-139-96.87-236-96.88-97-236.46-97-138.67 0-236 96.87-97.33 96.88-97.33 236.46 0 138.67 97.33 236 97.33 97.33 236.33 97.33ZM480-480Z" />
        </svg>
    </button>


    <div wire:show="showModal"
        class="fixed z-50 top-0 left-0 bg-gray-300/70 backdrop-blur-sm w-full h-dvh flex justify-center items-center">
        <div class="bg-gray-100 p-10 rounded-md relative shadow-lg">

            <button x-on:click="$wire.showModal = false"
                class="absolute top-2 right-2 bg-gray-200 rounded-md hover:bg-gray-300 cursor-pointer active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                    fill="#e3e3e3" class="fill-orange-700">
                    <path
                        d="m251.33-204.67-46.66-46.66L433.33-480 204.67-708.67l46.66-46.66L480-526.67l228.67-228.66 46.66 46.66L526.67-480l228.66 228.67-46.66 46.66L480-433.33 251.33-204.67Z" />
                </svg>
            </button>


            <h2 class="decor-regular text-4xl my-5 text-center">Nowy występ 🏆</h2>

            <form class="flex flex-col gap-4" wire:submit.prevent="save">
                <div class="flex flex-col gap-1">
                    <input type="text" wire:model="name" placeholder="Nazwa występu" class="text-xl p-2">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <textarea wire:model="description" placeholder="Opis występu" class="text-lg p-2 resize-none h-40"></textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="performance-date">
                        <span class="block label">
                            Data występu:
                        </span>

                        <input id="performance-date" type="datetime-local" wire:model="performance_date"
                            class="text-lg p-2">
                    </label>
                    @error('performance_date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="button button--big mt-5 mx-auto">Zapisz</button>
        </div>
    </div>

</div>
