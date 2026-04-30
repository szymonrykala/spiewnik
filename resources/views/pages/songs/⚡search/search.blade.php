<div class="container flex flex-col">

    <div class="flex justify-between items-center">
        <h1 class="decor-regular text-5xl text-left my-7">Piosenki:</h1>
        <a href="create" wire:navigate class="rounded-md bg-gray-200 size-fit p-2 hover:bg-gray-300/80">
            <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"
                class="fill-orange-700/70">
                <path
                    d="M448.67-280h66.66v-164H680v-66.67H515.33V-680h-66.66v169.33H280V-444h168.67v164Zm31.51 200q-82.83 0-155.67-31.5-72.84-31.5-127.18-85.83Q143-251.67 111.5-324.56T80-480.33q0-82.88 31.5-155.78Q143-709 197.33-763q54.34-54 127.23-85.5T480.33-880q82.88 0 155.78 31.5Q709-817 763-763t85.5 127Q880-563 880-480.18q0 82.83-31.5 155.67Q817-251.67 763-197.46q-54 54.21-127 85.84Q563-80 480.18-80Zm.15-66.67q139 0 236-97.33t97-236.33q0-139-96.87-236-96.88-97-236.46-97-138.67 0-236 96.87-97.33 96.88-97.33 236.46 0 138.67 97.33 236 97.33 97.33 236.33 97.33ZM480-480Z" />
            </svg>
        </a>
    </div>

    <form class="flex items-center justify-stretch">
        <input type="text" class="w-full px-4 text-xl text-inherit outline-0" placeholder="Czego szukasz" />
        <button class="button button--big">Search</button>
    </form>

    <div class="left-0 mt-0 flex w-full flex-col gap-2 p-4 pt-5">
        <ul class="flex flex-wrap gap-2">
            @foreach ($tags as $tag)
                <li class="tag {{ in_array($tag, $active_tags) ? 'tag--active' : '' }} group">
                    <span wire:click="toggle_tag('{{ $tag }}')">
                        {{ $tag }}
                    </span>
                    <span class="group-hover:block hidden transition">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px"
                            wire:click="removeTag('{{ $tag }}')">
                            <path
                                d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                        </svg>
                    </span>
                </li>
            @endforeach
        </ul>

        <form class="flex w-fit rounded-2xl bg-gray-100" wire:submit="addTag">
            <input type="text" wire:model="new_tag" placeholder="Dodaj tag" class="input--invisible" />
            <button class="button ">+</button>
        </form>
    </div>


    <div class="py-5 flex flex-col gap-3">
        <ul class="flex flex-col gap-3">
            @foreach ($this->songs as $song)
                <li class="rounded-md bg-white px-4 py-3 group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl">
                            <span class="text-orange-800">
                                ♫
                            </span>
                            <a class="group-hover:text-orange-700" href="/songs/{{ $song->id }}" wire:navigate>
                                {{ $song->title }}
                            </a>
                        </h3>

                        <p class="line-clamp-2 text-orange-950/70">{{
                            \Illuminate\Support\Str::limit(strip_tags($song->lyrics), 300)
                        }}</p>

                        <div class="flex justify-between">
                            <div class="flex gap-2 text-sm">
                                @foreach ($song->tags as $tag)
                                    <div class="tag">
                                        {{ $tag->name }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex gap-2 items-center">
                                @if ($song->yt_link)
                                    <div>YT</div>
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
        <div class="">
            {{ $this->songs->links() }}
        </div>
    </div>

</div>
