@if ($errors->any())
    <div class="bg-orange-200 py-3 px-2 rounded-md">
        @foreach ($errors->all() as $error)
            <p class="text-sm text-red-700">{{ $error }}</p>
        @endforeach
    </div>
@endif
