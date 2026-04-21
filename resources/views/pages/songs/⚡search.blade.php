<?php

use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component {
    public array $tags = ['Wejście', 'Wyjście', 'Ofiarowanie', 'Komunia'];

    #[Url]
    public array $active_tags = ['Wyjście'];

    #[Url]
    public string $search = '';
    public array $songs = [];

    public string $new_tag = '';

    function mount() {}

    function toggle_tag(string $tag)
    {
        if (in_array($tag, $this->active_tags)) {
            $this->active_tags = array_filter($this->active_tags, fn($t) => $t !== $tag);
        } else {
            array_push($this->active_tags, $tag);
        }
    }

    function addTag()
    {
        array_push($this->tags, $this->pull('new_tag'));
    }

    function removeTag(string $tag)
    {
        $this->tags = array_filter($this->tags, fn($t) => $t !== $tag);
    }

    function handleSearch()
    {
        $this->songs = [];
    }
};
?>

<div class="container mx-auto flex flex-col  max-w-5xl">

    <h1 class="decor-regular text-5xl text-left my-7">Piosenki:</h1>

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


    <div class="py-5">
        <ul class="flex flex-col gap-3">
            @foreach ([1, 2, 3] as $i)
                <li class="rounded-md bg-white px-4 py-3 group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl">
                            <span class="text-orange-800">
                                ♫
                            </span>
                            <a class="group-hover:text-orange-700" href="/songs/{{$i}}" wire:navigate> NiemaGoTu - Dzięki
                                Tobie </a>
                        </h3>

                        <p class="line-clamp-2 text-orange-950/70">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Eaque, repudiandae! Voluptate provident omnis eligendi sint eos modi architecto, ex quod
                            Eaque, repudiandae! Voluptate provident omnis eligendi sint eos modi architecto, ex quod
                            Eaque, repudiandae! Voluptate provident omnis eligendi sint eos modi architecto, ex quod
                            itaque dignissimos tenetur ullam repellat officiis doloribus possimus expedita fuga.</p>

                        <div class="flex justify-between">
                            <div class="flex gap-2 text-sm">
                                <div class="tag">Wyjście</div>
                                <div class="tag">Ofiarowanie</div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div>YT</div>
                                <div>🎼</div>
                                <div>📖</div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</div>
