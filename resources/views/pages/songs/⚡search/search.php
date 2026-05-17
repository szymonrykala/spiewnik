<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Models\Tag;
use App\Models\Song;
use Livewire\WithPagination;


new class extends Component {
    use WithPagination;

    #[Url]
    public ?string $performanceIdAssignment = null;

    public string $new_tag = '';

    #[Url]
    public array $active_tags = [];

    #[Url]
    public string $search = '';


    private function mostlyUsedSongs()
    {
        return Song::query()
            ->with('tags')
            ->withCount('performances')
            ->orderBy('performances_count', 'desc')
            ->simplePaginate(15);
    }

    #[Computed]
    public function songs()
    {
        if (empty($this->search) && count($this->active_tags) === 0) {
            return $this->mostlyUsedSongs();
        }

        return Song::query()->with('tags')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('lyrics', 'like', '%' . $this->search . '%');
            })
            ->when(count($this->active_tags) > 0, function ($query) {
                $query->whereHas('tags', function ($query) {
                    $query->whereIn('name', $this->active_tags);
                });
            })
            ->simplePaginate(15);
    }

    #[Computed]
    public function assignedPerformanceSongs()
    {
        if (!$this->performanceIdAssignment) {
            return collect();
        }

        return \App\Models\Performance::find($this->performanceIdAssignment)
            ?->songs()
            ->orderBy('performance_songs.position')
            ->get();
    }

    #[Computed]
    public function allTags()
    {
        return Tag::all()->pluck('name')->toArray();
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
        Tag::firstOrCreate([
            'name' => strtolower(trim($this->pull('new_tag')))
        ])->name;
    }

    function removeTag(string $tag)
    {
        Tag::where('name', $tag)->delete();

        if (in_array($tag, $this->active_tags)) {
            $this->active_tags = array_filter($this->active_tags, fn($t) => $t !== $tag);
        }
    }

    function assignToPerformance(int $songId)
    {
        if (!$this->performanceIdAssignment) {
            return;
        }

        $songsCount = \App\Models\Performance::find($this->performanceIdAssignment)->songs()->count();

        Song::find($songId)->performances()->syncWithoutDetaching([
            $this->performanceIdAssignment => [
                'position' => $songsCount + 1,
            ]
        ]);

        $this->dispatch('song-assigned-to-performance', ['songId' => $songId]);
    }
};
