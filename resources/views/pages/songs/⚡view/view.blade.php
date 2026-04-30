<article class="flex flex-col gap-10 mx-auto container">

    <div class="flex gap-5 rounded-xl bg-gray-200 fixed top-3 w-fit right-3 self-end p-3 z-50">

        <button wire:show="!editMode" wire:click="enableEditMode" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                class="fill-orange-700">
                <path
                    d="M186.67-186.67H235L680-631l-48.33-48.33-445 444.33v48.33ZM120-120v-142l559.33-558.33q9.34-9 21.5-14 12.17-5 25.5-5 12.67 0 25 5 12.34 5 22 14.33L821-772q10 9.67 14.5 22t4.5 24.67q0 12.66-4.83 25.16-4.84 12.5-14.17 21.84L262-120H120Zm652.67-606-46-46 46 46Zm-117 71-24-24.33L680-631l-24.33-24Z" />
            </svg>
            <span class="text-xs">
                Edytuj
            </span>
        </button>

        <button wire:show="!editMode" wire:click="removeSong" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#e3e3e3" class="fill-red-500">
                <path
                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
            </svg>
            <span class="text-xs">
                Usuń
            </span>
        </button>

        <button wire:show="editMode" wire:click="saveButtonHandler" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#e3e3e3" class="fill-green-700">
                <path
                    d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM565-275q35-35 35-85t-35-85q-35-35-85-35t-85 35q-35 35-35 85t35 85q35 35 85 35t85-35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z" />
            </svg>
            <span class="text-xs">
                Zapisz
            </span>
        </button>

        <button wire:show="editMode" wire:click="cancelButtonHandler" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#e3e3e3" class="fill-red-500">
                <path
                    d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
            </svg>
            <span class="text-xs">
                Anuluj
            </span>
        </button>
    </div>

    <section class="flex flex-col gap-3 my-5">
        @if ($editMode)
            <input wire:model.live.debounce.1000ms="songTitle" type="text"
                class="input--invisible p-0 text-6xl decor-regular" placeholder="Tytuł piosenki">
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
                            {{ $tag}}
                            <span class="group-hover:block hidden transition">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960"
                                    width="18px" wire:click="removeTagFromSong('{{ $tag }}')">
                                    <path
                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                </svg>
                            </span>

                        </div>
                    </li>
                @endforeach

            <li wire:show="editMode">
                <form wire:submit.prevent="addTagToSong" class="flex gap-2">
                    <input type="text" placeholder="Dodaj tag" class="input--invisible" wire:model="newTag">
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
    @push('head')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    @endpush

    <section x-data="{ edit: @entangle('editMode') }">
        <h2 class="text-gray-500">Tekst:</h2>
        <div class="text-wrap">

            <!-- VIEW -->
            <div x-show="!edit">
                <div x-html="$wire.textContent"></div>
            </div>

            <!-- EDIT -->
            <div x-show="edit">

                <input type="hidden" id="body-input">

                <div wire:ignore x-data x-init="const editor = $el.querySelector('trix-editor')

                const setContent = () => {
                    if (!editor.editor) return
                    editor.editor.loadHTML($wire.textContent || '')
                }

                $watch('edit', value => {
                    if (value) {
                        setTimeout(setContent, 0)
                    }
                })

                // fallback przy pierwszym init
                editor.addEventListener('trix-initialize', setContent)

                editor.addEventListener('trix-change', (e) => {
                    $wire.set('textContent', e.target.value)
                })">

                    <trix-editor input="body-input" placeholder="Tekst piosenki"
                        class="block trix-content min-h-[200px] border w-full p-4">
                    </trix-editor>

                </div>
            </div>
        </div>
    </section>

    {{-- ZDJĘCIE --}}
    <section wire:show="editMode || savedPhotoPath">
        <label for="lyrics-photo" class="block cursor-pointer w-fit">
            <figure>
                <img src="{{ $this->displayImage }}" alt="Zdjęcie tekstu piosenki" class="max-h-150 object-contain">
            </figure>
        </label>
        @if ($editMode)
            <input type="file" id="lyrics-photo" wire:model="photo" class="hidden">
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
                            class="w-full" placeholder="Link do YouTube">
                        <iframe wire:show="ytLink" width="560" height="30vh" class="w-full h-[35vh]"
                            src="{{ $ytLink }}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </li>
                @endif

                @if ($editMode || $msLink)
                    <li>
                        <input type="text" wire:show="editMode" wire:model.live.debounce.1000ms="msLink"
                            class="w-full" placeholder="Link do MusicXML">
                        <iframe wire:show="msLink" id="score-iframe" width="100%" height="3vh"
                            class="w-full h-[35vh]" src="{{ $msLink }}" frameborder="0" allowfullscreen
                            allow="autoplay; fullscreen"></iframe>
                    </li>
                @endif
            </ul>
        </section>
    @endif

</article>
