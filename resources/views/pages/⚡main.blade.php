<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Tag;
use App\Models\Performance;

new class extends Component {
    #[Computed]
    public function allTags()
    {
        return Tag::all();
    }

    #[Computed]
    public function nextPerformance()
    {
        return Performance::where('performance_date', '>', now())->orderBy('performance_date', 'asc')->first();
    }
};
?>

<div class="container mx-auto max-w-2xl">
    <section>
        <h2 class="label">Główne tagi</h2>
        <ul class="flex gap-5">
            @foreach ($this->allTags as $tag)
                <li>
                    <div class="tag tag--big">{{ $tag }}</div>
                </li>
            @endforeach

            <li>
                <div class="tag tag--big">Zaduszki</div>
            </li>
            <li>
                <div class="tag tag--big">Świąteczne</div>
            </li>
        </ul>
    </section>

    <section>
        <h2>Następne występy:</h2>
        <ul>
            <li>Lorem ipsum. Explicabo, illum id.</li>
            <li>Lorem ipsum. Explicabo, illum id.</li>
            <li>Lorem ipsum. Explicabo, illum id.</li>
        </ul>
    </section>

    <section>
        <h2>Nowe piosenki:</h2>
        <ul>
            <li>Lorem ipsum. Explicabo, illum id.</li>
            <li>Lorem ipsum. Explicabo, illum id.</li>
            <li>Lorem ipsum. Explicabo, illum id.</li>
            <li>Lorem ipsum. Explicabo, illum id.</li>
        </ul>
    </section>
</div>
