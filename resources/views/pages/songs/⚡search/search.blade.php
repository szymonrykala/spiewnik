<div
    wire:transition
    class="items-top flex justify-center"
>

    <div class="container w-full space-y-5 md:space-y-5 md:p-3">
        <div
            class="flex grow items-center justify-stretch rounded-md bg-gray-100 px-3 py-3 focus:shadow-xl md:px-4 md:py-4">
            <input
                wire:model.live.debounce.700ms="search"
                type="search"
                class="w-full text-xl text-orange-900 outline-0 md:text-2xl"
                placeholder="Szukaj piosenki..."
            />
            <button
                type="submit"
                class="cursor-pointer text-2xl transition-transform hover:-rotate-12 md:text-3xl"
            >🔎</button>
        </div>

        <div class="left-0 flex w-full flex-col gap-2 md:p-4">
            <ul class="flex flex-wrap gap-2">
                @foreach ($this->allTags as $tag)
                    <li
                        wire:transition.opacity
                        wire:key="{{ $tag }}"
                        class="tag {{ in_array($tag, $active_tags) ? 'tag--active' : '' }} group"
                    >
                        <span wire:click="toggle_tag('{{ $tag }}')">
                            {{ $tag }}
                        </span>
                        @admin
                            <span class="hidden transition group-hover:block">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="18px"
                                    viewBox="0 -960 960 960"
                                    width="18px"
                                    wire:click="removeTag('{{ $tag }}')"
                                >
                                    <path
                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"
                                    />
                                </svg>
                            </span>
                        @endadmin
                    </li>
                @endforeach
            </ul>

            @admin
                <form
                    class="flex w-fit rounded-2xl bg-gray-100 px-2"
                    wire:submit="addTag"
                >
                    <input
                        type="text"
                        wire:model="new_tag"
                        placeholder="Nowy tag..."
                        class="max-w-40 text-sm outline-0"
                    />
                    <button class="cursor-pointer text-3xl text-orange-700/80">⊕</button>
                </form>
            @endadmin
        </div>

        @if ($performanceIdAssignment)
            <div class="space-y-1">
                <h2 class="label">Przypisane do występu:</h2>
                <ul class="flex flex-col gap-3">
                    @foreach ($this->assignedPerformanceSongs as $song)
                        <x-song-list-item
                            wire:key="assigned-{{ $song->id }}"
                            :song=$song
                            :performance-id=$performanceIdAssignment
                            removeAssignment="unassignFromPerformance({{ $song->id }})"
                        />
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <h2 class="label">Znalezione piosenki:</h2>
                @admin
                    <a
                        role="button"
                        title="Dodaj nową piosenkę"
                        href="{{ route('songs.create') }}"
                        class="flex items-center justify-center"
                    >
                        <span class="text-3xl text-orange-700/80">
                            ⊕
                        </span>
                    </a>
                @endadmin

            </div>
            <ul class="flex flex-col gap-3">
                @foreach ($this->songs as $song)
                    <x-song-list-item
                        wire:key="song-{{ $song->id }}"
                        :song=$song
                        :activeTags=$active_tags
                        assignToPerformance="assignToPerformance({{ $song->id }})"
                        :performance-id=$performanceIdAssignment
                    />
                @endforeach
            </ul>
            <div>
                {{ $this->songs->links() }}
            </div>
        </div>
    </div>
</div>
