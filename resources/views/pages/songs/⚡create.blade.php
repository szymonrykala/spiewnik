<?php

use Models\Song;
use Models\File;
use Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;


new class extends Component
{
    use WithFileUploads;

    public string $title;
    public array $tags = [];
    public array $links = [];
    public string $content;

    #[Validate('image|max:5096')]
    public $photo;

    public $audio;

    function save(){
        $this->validate();

        $photo = $this->photo->store(path:'photos');
        dd($photo);
        // Song::save()

    }
};
?>

<div>
    <h1>Dodaj piosenkę</h1>
    <form method="dialog" wire:submit="save">
        <input type="text" name="title" placeholder="Tytuł">
        <input type="text" name="newTag" placeholder="Dodaj Tag">
        <textarea name="content" id="content" cols="50" rows="20" placeholder="Tekst piosenki"></textarea>
        <input type="file" name="image">
        <input type="file" name="recording">
        <input type="url" name="newLink">

        <button type="submit">Zapisz</button>
    </form>
</div>
