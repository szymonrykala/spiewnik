<article class="container mx-auto flex flex-col gap-10">

    @admin
        <x-edit-toolbar
            :edit="$editMode"
            on-edit="enableEditMode"
            on-remove="removeSong"
            on-save="saveButtonHandler"
            on-cancel="cancelButtonHandler"
        />
    @endadmin

    <section class="my-5 flex flex-col gap-3">
        @if ($editMode)
            <input
                wire:model.live.debounce.1000ms="songTitle"
                type="text"
                class="input input--invisible decor-regular p-0 text-6xl"
                placeholder="Tytuł piosenki"
            >
            @error('songTitle')
                <span class="error">{{ $message }}</span>
            @enderror
        @else
            <h1 class="decor-regular text-4xl md:text-6xl">
                {{ $songTitle }}
            </h1>
        @endif

        <ul class="flex flex-wrap items-center gap-2">
            @foreach ($this->tags as $tag)
                <li>
                    <div class="tag group">
                        {{ $tag }}
                        @if ($editMode)
                            <span class="hidden transition group-hover:block">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="18px"
                                    viewBox="0 -960 960 960"
                                    width="18px"
                                    wire:click="removeTagFromSong('{{ $tag }}')"
                                >
                                    <path
                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"
                                    />
                                </svg>
                            </span>
                        @endif
                    </div>
                </li>
            @endforeach

            <li wire:show="editMode">
                <form
                    wire:submit.prevent="addTagToSong"
                    class="flex gap-2"
                >
                    <input
                        type="text"
                        placeholder="Dodaj tag"
                        class="input input--invisible"
                        wire:model="newTag"
                    >
                    <button
                        type="submit"
                        class="button"
                    > Dodaj</button>
                </form>
            </li>

        </ul>
        @error('newTag')
            <span class="error">{{ $message }}</span>
        @enderror
        @if ($song)
            <div class="label">
                <p>Dodane przez {{ $song->createdBy->name ?? 'Anonim' }} dnia
                    {{ $song->created_at->format('d.m.Y H:i') }}
                </p>
                <p>Ostatnia edycja przez {{ $song->updatedBy->name ?? 'Anonim' }} dnia
                    {{ $song->updated_at->format('d.m.Y H:i') }}</p>
            </div>
        @endif
    </section>

    {{-- NAGRANIE --}}
    {{-- <section>
        <h2 class="text-gray-500">Nagranie:</h2>
        <div class="flex items-center justify-between">
            <div>
                <audio controls>
                    <source
                        src=""
                        type="audio/mpeg"
                    >
                    Your browser does not support the audio element.
                </audio>
                <span class="label">Z dnia 23.04.2026</span>
            </div>

            <livewire:voice-recorder />

        </div>
    </section> --}}

    {{-- TEKST --}}
    <section>
        <h2 class="text-gray-500">Tekst:</h2></br>
        <x-rich-editor
            model-name="textContent"
            edit-indicator="editMode"
            placeholder="Wprowadź tekst piosenki..."
        />
    </section>

    {{-- ZDJĘCIE --}}
    <section wire:show="editMode || savedPhotoPath" class="space-y-2">
        <div class="block w-fit cursor-pointer">
            <x-image
                src="{{ $this->displayImage }}"
                alt="Zdjęcie tekstu piosenki"
                class="max-h-150 object-contain"
            />
        </div>

        @if ($editMode)
            <input
                type="file"
                id="lyrics-photo"
                wire:model="photo"
                class="button w-fit"
            >
            <button
                wire:click="removePhoto"
                class="button"
            >Usuń zdjęcie</button>
            @error('photo')
                <span class="error">{{ $message }}</span>
            @enderror
        @endif
    </section>

    {{-- LINKI --}}

    @if ($editMode || $ytLink || $msLink)
        <section>
            <h2 class="text-gray-500">Linki:</h2>
            <ul class="gird-cols-1 grid gap-3 md:grid-cols-2">
                @if ($editMode || $ytLink)
                    <li>
                        <input
                            type="text"
                            wire:show="editMode"
                            wire:model.live.debounce.1000ms="ytLink"
                            class="input w-full"
                            placeholder="Link do YouTube"
                        >
                        <iframe
                            wire:show="ytLink"
                            width="560"
                            height="30vh"
                            class="h-[35vh] w-full"
                            src="{{ $ytLink }}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                        ></iframe>
                    </li>
                @endif

                @if ($editMode || $msLink)
                    <li>
                        <input
                            type="text"
                            wire:show="editMode"
                            wire:model.live.debounce.1000ms="msLink"
                            class="input w-full"
                            placeholder="Link do MusicXML"
                        >
                        <iframe
                            wire:show="msLink"
                            id="score-iframe"
                            width="100%"
                            height="3vh"
                            class="h-[35vh] w-full"
                            src="{{ $msLink }}"
                            frameborder="0"
                            allowfullscreen
                            allow="autoplay; fullscreen"
                        ></iframe>
                    </li>
                @endif
            </ul>
        </section>
    @endif

</article>
