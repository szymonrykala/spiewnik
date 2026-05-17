<article class="flex flex-col gap-10 mx-auto container">

    <x-edit-toolbar :edit="$editMode" on-edit="enableEditMode" on-save="saveButtonHandler"
        on-cancel="cancelButtonHandler" />

    <section class="flex flex-col gap-3 my-5">
        @if ($editMode)
            <input wire:model.live.debounce.1000ms="songTitle" type="text"
                class="input input--invisible p-0 text-6xl decor-regular" placeholder="Tytuł piosenki">
            @error('songTitle')
                <span class="error">{{ $message }}</span>
            @enderror
        @else
            <h1 class="text-6xl decor-regular">
                {{ $songTitle }}
            </h1>
        @endif

        <ul class="flex gap-2 items-center flex-wrap">
            @foreach ($this->tags as $tag)
                <li>
                    <div class="tag group">
                        {{ $tag }}
                        @if ($editMode)
                            <span class="group-hover:block hidden transition">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960"
                                    width="18px" wire:click="removeTagFromSong('{{ $tag }}')">
                                    <path
                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </li>
            @endforeach

            <li wire:show="editMode">
                <form wire:submit.prevent="addTagToSong" class="flex gap-2">
                    <input type="text" placeholder="Dodaj tag" class="input input--invisible" wire:model="newTag">
                    <button type="submit" class="button"> Dodaj</button>
                </form>
            </li>

        </ul>
        @error('newTag')
            <span class="error">{{ $message }}</span>
        @enderror
        @if ($song)
            <div class="label">
                <p>Dodane przez {{ $song->user?->name ?? 'Anonim' }} dnia {{ $song->created_at->format('d.m.Y H:i') }}
                </p>
                <p>Ostatnia edycja przez {{ $song->user?->name ?? 'Anonim' }} dnia
                    {{ $song->updated_at->format('d.m.Y H:i') }}</p>
            </div>
        @endif
    </section>

    {{-- NAGRANIE --}}
    <section>
        <h2 class="text-gray-500">Nagranie:</h2>
        <div class="flex justify-between items-center">
            <div>
                <audio controls>
                    <source src="" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <span class="label">Z dnia 23.04.2026</span>
            </div>

            <livewire:voice-recorder />

        </div>
    </section>

    {{-- TEKST --}}
    <section>
        <h2 class="text-gray-500">Tekst:</h2></br>
        <x-rich-editor model-name="textContent" edit-indicator="editMode" placeholder="Wprowadź tekst piosenki..." />
    </section>

    {{-- ZDJĘCIE --}}
    <section wire:show="editMode || savedPhotoPath">
        <label for="lyrics-photo" class="block cursor-pointer w-fit">
            <div>
                <x-image src="{{ $this->displayImage }}" alt="Zdjęcie tekstu piosenki"
                    class="max-h-150 object-contain" />
            </div>
        </label>
        @if ($editMode)
            <input type="file" id="lyrics-photo" wire:model="photo" class="input hidden">
            <button wire:click="removePhoto" class="button">Usuń zdjęcie</button>
            @error('photo')
                <span class="error">{{ $message }}</span>
            @enderror
        @endif
    </section>

    {{-- LINKI --}}

    @if ($editMode || $ytLink || $msLink)
        <section>
            <h2 class="text-gray-500">Linki:</h2>
            <ul class="grid gird-cols-1 gap-3 md:grid-cols-2">
                @if ($editMode || $ytLink)
                    <li>
                        <input type="text" wire:show="editMode" wire:model.live.debounce.1000ms="ytLink"
                            class="input w-full" placeholder="Link do YouTube">
                        <iframe wire:show="ytLink" width="560" height="30vh" class="w-full h-[35vh]"
                            src="{{ $ytLink }}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </li>
                @endif

                @if ($editMode || $msLink)
                    <li>
                        <input type="text" wire:show="editMode" wire:model.live.debounce.1000ms="msLink"
                            class="input w-full" placeholder="Link do MusicXML">
                        <iframe wire:show="msLink" id="score-iframe" width="100%" height="3vh"
                            class="w-full h-[35vh]" src="{{ $msLink }}" frameborder="0" allowfullscreen
                            allow="autoplay; fullscreen"></iframe>
                    </li>
                @endif
            </ul>
        </section>
    @endif

</article>
