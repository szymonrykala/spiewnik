<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Models\Song;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

new class extends Component {
    use WithFileUploads;

    public ?Song $song = null;

    #[Validate('string|max:255|min:5')]
    public ?string $songTitle = null;

    public array $newTags = [];

    #[Validate('string|max:50|min:3')]
    public ?string $newTag = null;

    // https://yt/embed/<id>
    public ?string $ytLink = null;

    // https://<link>/embed
    public ?string $msLink = null;

    #[Validate('image|max:3096')]
    public $photo = null;

    public ?string $savedPhotoPath = null;

    public ?string $textContent = null;

    public bool $editMode = false;


    public function mount()
    {
        if ($this->song === null) {
            $this->editMode = true;
        }
        $this->songTitle = $this->song?->title;
        $this->ytLink = $this->song?->yt_link;
        $this->msLink = $this->song?->ms_link;
        $this->savedPhotoPath = $this->song?->photo_url;
        $this->textContent = $this->song?->lyrics;
    }

    #[Computed]
    public function getTagsProperty()
    {
        return array_merge(
            $this->song?->tags->pluck('name')->toArray() ?? [],
            $this->newTags
        );
    }

    #[Computed]
    public function getDisplayImageProperty()
    {
        return match (true) {
            (bool) $this->savedPhotoPath => asset('storage/' . $this->savedPhotoPath),
            (bool) $this->photo => $this->photo->temporaryUrl(),
            default => asset('storage/defaults/image.png'),
        };
    }

    public function updated(string $property, $value)
    {
        if ($property === 'ytLink' && $value) {
            $this->ytLink = str_replace('watch?v=', 'embed/', $value);
        }

        if ($property === 'msLink' && $value) {
            $this->msLink = $value . '/embed';
        }

        if ($property === 'photo' && $value) {
            $this->savedPhotoPath = null;
        }
    }

    public function addTagToSong()
    {
        $this->validate(['newTag' => 'string|max:25|min:3']);
        $this->newTags[] = strtolower(trim($this->pull('newTag')));
    }

    public function removeTagFromSong(string $tag)
    {
        $this->newTags = array_filter($this->newTags, fn($t) => $t !== $tag);
        $this->song?->tags()->detach(Tag::where('name', $tag)->first()?->id);
    }

    public function enableEditMode()
    {
        $this->editMode = true;
    }

    public function createSong()
    {
        $this->song = new Song();

        $this->song->title = $this->songTitle;
        $this->song->lyrics = $this->textContent;
        $this->song->yt_link = $this->ytLink;
        $this->song->ms_link = $this->msLink;
        $this->song->photo_url = $this->savedPhotoPath;
        $this->song->save();

        $this->song->tags()->attach(
            collect($this->newTags)->map(fn($name) => Tag::firstOrCreate([
                'name' => trim($name)
            ])->id)
        );
        $this->newTags = [];

        $this->song->save();
    }

    public function updateSong()
    {
        if ($this->savedPhotoPath !== $this->song->photo_url && $this->song->photo_url) {
            Storage::disk('public')->delete($this->song->photo_url);
        }

        $this->song->update([
            'title' => $this->songTitle,
            'lyrics' => $this->textContent,
            'yt_link' => $this->ytLink,
            'ms_link' => $this->msLink,
            'photo_url' => $this->savedPhotoPath,
        ]);

        $this->song->tags()->syncWithoutDetaching(
            collect($this->newTags)->map(fn($name) => Tag::firstOrCreate([
                'name' => trim($name)
            ])->id)
        );
        $this->newTags = [];
    }

    public function saveButtonHandler()
    {
        $this->editMode = false;

        if ($this->photo) {
            $url = $this->photo->storeAs(path: 'lyrics', name: Str::random(40) . '.' . $this->photo->getClientOriginalExtension(), options: 'public');
            $this->savedPhotoPath = $url;
        }

        if ($this->song === null) {
            $this->createSong();
            return;
        }
        $this->updateSong();
    }

    public function cancelButtonHandler()
    {
        if ($this->song === null) {
            return redirect()->route('songs.index');
        }

        $this->editMode = false;
    }

    public function removePhoto()
    {
        Storage::disk('public')->delete($this->savedPhotoPath);
        $this->savedPhotoPath = null;
        $this->photo = null;
    }

    public function removeSong()
    {
        $this->song?->delete();
        return redirect()->route('songs.index');
    }
};
