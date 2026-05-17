<article class="flex flex-col gap-6 container">

    <x-edit-toolbar :edit="$editMode" on-edit="enableEditMode" on-save="save" on-cancel="cancel"
        on-remove="deletePerformance" />

    <section class="flex flex-col gap-4">
        <div class="text-6xl decor-regular">
            @if ($editMode)
                <input type="text" wire:model="form.name" placeholder="Nazwa występu...">
            @else
                <h1>
                    {{ $form->name }}
                </h1>
            @endif

        </div>
        <div>
            <span class="label">Kiedy:</span>
            <div class="text-2xl">
                @if ($editMode)
                    <input type="date" class="input" wire:model="form.performance_date">
                @else
                    <p>{{ $form->performance_date }}</p>
                @endif
            </div>
        </div>
        <div>
            <span class="label">Notatki:</span>
            <x-rich-editor model-name="form.description" edit-indicator="editMode" placeholder="Wprowadź notatki..." />
        </div>

        @if ($performance)
            <div>
                <livewire:gospel-loader :performance="$performance" />
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 bg-red-100 rounded-md">
                <ul class="list-disc list-inside text-red-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>

        </div>
    </section>

    @if ($performance === null)
        <div class="p-4 bg-yellow-100 rounded-md">
            <p class="text-yellow-800">Tworzysz nowy występ. Po zapisaniu będziesz mógł przypisać do niego piosenki.</p>
        </div>
    @else
        <section class="flex flex-col gap-10">
            <ul class="flex gap-1 bg-gray-300 p-2 pb-0 overflow-x-auto scrollbar-none rounded-md">
                @foreach ($this->performanceSongs as $song)
                    <li wire:key="song-label-{{ $song->id }}"
                        class="flex gap-2 items-center py-2 px-4 cursor-pointer rounded-t-lg text-nowrap {{ $currentSongId == $song->id ? 'bg-gray-200' : 'hover:bg-gray-200/50' }}"
                        wire:click="switchSongView({{ $song->id }})">
                        <span>{{ $song->title }}</span>

                        <span wire:show="currentSongId == {{ $song->id }}" class="block fill-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960"
                                width="18px" wire:click.stop="removeSong('{{ $song->id }}')">
                                <path
                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </span>
                    </li>
                @endforeach
                <li class="px-2">
                    <a href="/songs?performanceIdAssignment={{ $performance?->id }}" wire:navigate>
                        <span class="text-4xl text-orange-700">
                            ⊕
                        </span>
                    </a>
                </li>
            </ul>

            @foreach ($this->performanceSongs as $song)
                <article wire:key="song-{{ $song->id }}" wire:show="currentSongId === {{ $song->id }}"
                    class="flex flex-col gap-4">
                    <h2 class="text-4xl decor-regular">
                        <a wire:navigate href="/songs/{{ $song->id }}">
                            {{ $song->title }}
                        </a>
                    </h2>
                    <div>{!! $song->lyrics !!}</div>
                    <div>
                        <x-image src="{{ asset('storage/' . $song->photo_url) }}" alt="Zdjęcie tekstu piosenki"
                            class="max-h-150 object-contain" />
                    </div>
                </article>
            @endforeach
        </section>
    @endif

</article>
