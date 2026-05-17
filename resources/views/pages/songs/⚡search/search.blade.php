<div wire:transition.opacity.duration.500ms class="flex justify-center items-top">

    <div class="p-5 rounded-xl w-full container">

        <div class="flex items-center justify-stretch bg-gray-100 shadow-xl rounded-md py-3 px-4">
            <input wire:model.live.debounce.700ms="search" type="text"
                class="w-full text-2xl  text-orange-900 outline-0" placeholder="Szukaj piosenki..." />
            <button type="submit" class="text-4xl cursor-pointer hover:-rotate-12 transition-transform">🔎</button>
        </div>

        <div class="left-0 mt-0 flex w-full flex-col gap-2 p-4 pt-5">
            <ul class="flex flex-wrap gap-2">
                @foreach ($this->allTags as $tag)
                    <li wire:transition.opacity wire:key="{{ $tag }}"
                        class="tag {{ in_array($tag, $active_tags) ? 'tag--active' : '' }} group">
                        <span wire:click="toggle_tag('{{ $tag }}')">
                            {{ $tag }}
                        </span>
                        <span class="group-hover:block hidden transition">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960"
                                width="18px" wire:click="removeTag('{{ $tag }}')">
                                <path
                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </span>
                    </li>
                @endforeach
            </ul>

            <form class="flex w-fit px-2 rounded-2xl bg-gray-100" wire:submit="addTag">
                <input type="text" wire:model="new_tag" placeholder="Nowy tag..." class="outline-0" />
                <button class="text-3xl text-orange-700/80 cursor-pointer">⊕</button>
            </form>
        </div>

        <div class="py-5 flex flex-col gap-3">
            <ul class="flex flex-col gap-3">
                @foreach ($this->songs as $song)
                    <li wire:key="song-{{ $song->id }}" wire:transition
                        class="relative rounded-md bg-gray-100/80 px-4 py-3 group" wire:transition>

                        @if ($performanceIdAssignment)
                            @php
                                $assigned = $this->assignedPerformanceSongs->contains($song->id);
                            @endphp

                            <span wire:click="assignToPerformance({{ $song->id }})"
                                class="{{ $assigned ? 'block' : 'hidden' }} group-hover:block absolute cursor-pointer hover:text-orange-700 text-5xl text-orange-700/50 top-1 right-1">
                                ⊕
                            </span>
                        @endif

                        <div class="flex flex-col gap-1">
                            <h3 class="text-xl">
                                <span class="text-orange-800">
                                    ♫
                                </span>
                                <a class="group-hover:text-orange-700" href="/songs/{{ $song->id }}" wire:navigate>
                                    {{ $song->title }}
                                </a>
                            </h3>

                            <p class="line-clamp-1 text-orange-950/70">
                                {{ \Illuminate\Support\Str::limit(strip_tags($song->lyrics), 300) }}</p>

                            <div class="flex justify-between">
                                <div class="flex gap-2 text-sm">
                                    @foreach ($song->tags as $tag)
                                        <div class="tag {{ in_array($tag->name, $active_tags) ? 'tag--active' : '' }}">
                                            {{ $tag->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex gap-2 items-center">
                                    @if ($song->yt_link)
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" height="20px" width="20px"
                                                version="1.1" id="Layer_1" viewBox="0 0 512 512"
                                                xml:space="preserve">
                                                <path style="fill:#D8362A;"
                                                    d="M506.703,145.655c0,0-5.297-37.959-20.303-54.731c-19.421-22.069-41.49-22.069-51.2-22.952  C363.697,62.676,256,61.793,256,61.793l0,0c0,0-107.697,0.883-179.2,6.179c-9.71,0.883-31.779,1.766-51.2,22.952  C9.71,107.697,5.297,145.655,5.297,145.655S0,190.676,0,235.697v41.49c0,45.021,5.297,89.159,5.297,89.159  s5.297,37.959,20.303,54.731c19.421,22.069,45.021,21.186,56.497,23.835C122.703,449.324,256,450.207,256,450.207  s107.697,0,179.2-6.179c9.71-0.883,31.779-1.766,51.2-22.952c15.007-16.772,20.303-54.731,20.303-54.731S512,321.324,512,277.186  v-41.49C512,190.676,506.703,145.655,506.703,145.655" />
                                                <polygon style="fill:#FFFFFF;"
                                                    points="194.207,166.841 194.207,358.4 361.931,264.828 " />
                                            </svg>
                                        </div>
                                    @endif
                                    @if ($song->ms_link)
                                        <div>🎼</div>
                                    @endif
                                    @if ($song->lyrics)
                                        <div>📖</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div>
                {{ $this->songs->links() }}
            </div>
        </div>
    </div>
</div>
