<?php

use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Tag;
use App\Models\Song;
use Livewire\WithPagination;


new class extends Component
{
    use WithPagination;

    public array $tags = [];

    #[Url]
    public array $active_tags = [];

    #[Url]
    public string $search = '';

    public string $new_tag = '';


    function mount()
    {
        $this->tags = Tag::all()->pluck('name')->toArray();
    }

    #[Computed]
    public function songs()
    {
        return Song::with('tags')->simplePaginate(10);
    }

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
        $this->tags[] = Tag::firstOrCreate([
            'name' => strtolower(trim($this->pull('new_tag')))
        ])->name;
    }

    function removeTag(string $tag)
    {
        $this->tags = array_filter($this->tags, fn($t) => $t !== $tag);
        Tag::where('name', $tag)->delete();
    }

    function handleSearch()
    {
        // $this->songs = Song::with('tags')->paginate(20);
    }

};
