@props(['modelName', 'editIndicator', 'placeholder' => ''])

@once
    @push('head')
        <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css">

        <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script>
    @endpush
@endonce


<div class="text-wrap rich-editor">
    <div x-show="!$wire.{{ $editIndicator }}">
        <div x-html="$wire.{{ $modelName }} || '{{ $placeholder }}'"></div>
    </div>

    <div x-show="$wire.{{ $editIndicator }}">
        <livewire:jodit-text-editor wire:model.live.delay.1000="{{ $modelName }}" {{-- :buttons="[
            'bold',
            'italic',
            'underline',
            'strikeThrough',
            '|',
            'left',
            'center',
            'right',
            '|',
            'link',
            'image',
        ]"  --}} />
    </div>

</div>
