<?php

use Livewire\Component;
use App\Models\Performance;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use Livewire\Form;


class PerformanceForm extends Form
{
    public ?Performance $performance = null;

    #[Validate('required|min:5|max:255')]
    public ?string $name = null;

    #[Validate('required|max:2000')]
    public ?string $description = "Brak notatek do występu";

    #[Validate('required')]
    public ?string $performance_date = null;

    public function setPerformance(Performance $performance)
    {
        $this->performance = $performance;
        $this->name = $performance->name;
        $this->description = $performance->description;
        $this->performance_date = $performance->performance_date->format('Y-m-d');
    }

    public function removeSong(int $songId)
    {
        if ($this->performance === null) {
            return;
        }

        $this->performance->songs()->detach($songId);
        $this->performance->refresh();
    }

    public function store(): Performance
    {
        $this->validate();
        return Performance::create([
            'name' => $this->name,
            'description' => $this->description,
            'performance_date' => $this->performance_date,
        ]);
    }

    public function update()
    {
        $this->validate();
        $this->performance->update([
            'name' => $this->name,
            'description' => $this->description,
            'performance_date' => $this->performance_date,
        ]);
    }
}

new class extends Component {
    public PerformanceForm $form;
    public ?Performance $performance = null;

    public bool $editMode = false;

    #[Url]
    public ?int $currentSongId = null;


    #[Computed]
    public function performanceSongs()
    {
        if ($this->performance === null) {
            return collect();
        }

        return $this->performance->songs()->get();
    }

    public function mount()
    {
        if ($this->performance === null) {
            $this->editMode = true;
            return;
        }

        $this->form->setPerformance($this->performance);

        $this->assignFirstSongToView();
    }

    public function enableEditMode()
    {
        $this->editMode = true;
    }

    public function save()
    {
        if ($this->performance === null) {
            $new = $this->form->store();
            return redirect("/performances/{$new->id}");
        } else {
            $this->form->update();
            $this->editMode = false;
        }
    }

    public function cancel()
    {
        if ($this->performance === null) {
            return redirect("/performances");
        } else {
            $this->form->setPerformance($this->performance);
            $this->editMode = false;
        }
    }

    public function deletePerformance()
    {
        $this->performance->delete();
        return redirect("/performances");
    }


    public function assignFirstSongToView()
    {
        if ($this->performanceSongs->pluck('id')->doesntContain($this->currentSongId)) {
            $this->currentSongId = $this->performanceSongs->first()->id ?? null;
        }
    }

    public function switchSongView(int $songId)
    {
        $this->currentSongId = $songId;
    }

    public function removeSong(int $songId)
    {
        $this->performance->songs()->detach($songId);
        $this->performance->refresh();
        $this->assignFirstSongToView();
    }
};
