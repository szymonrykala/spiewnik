@props([
    'edit', // indicators
    'onRemove' => null,
    'onEdit' => null,
    'onSave' => null,
    'onCancel' => null,
])

<div class="flex gap-5 rounded-xl bg-gray-100 fixed top-3 w-fit right-3 self-end p-3 z-50 shadow-md">

    @if (!$edit && $onEdit)
        <button wire:click="{{ $onEdit }}" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                class="fill-orange-700">
                <path
                    d="M186.67-186.67H235L680-631l-48.33-48.33-445 444.33v48.33ZM120-120v-142l559.33-558.33q9.34-9 21.5-14 12.17-5 25.5-5 12.67 0 25 5 12.34 5 22 14.33L821-772q10 9.67 14.5 22t4.5 24.67q0 12.66-4.83 25.16-4.84 12.5-14.17 21.84L262-120H120Zm652.67-606-46-46 46 46Zm-117 71-24-24.33L680-631l-24.33-24Z" />
            </svg>
            <span class="text-xs">
                Edytuj
            </span>
        </button>
    @endif

    @if ($onRemove)
        <button wire:click="{{ $onRemove }}" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#e3e3e3" class="fill-red-500">
                <path
                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
            </svg>
            <span class="text-xs">
                Usuń
            </span>
        </button>
    @endif

    @if ($edit && $onSave)
        <button wire:click="{{ $onSave }}" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#e3e3e3" class="fill-green-700">
                <path
                    d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM565-275q35-35 35-85t-35-85q-35-35-85-35t-85 35q-35 35-35 85t35 85q35 35 85 35t85-35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z" />
            </svg>
            <span class="text-xs">
                Zapisz
            </span>
        </button>
    @endif

    @if ($edit && $onCancel)
        <button wire:click="{{ $onCancel }}" class="flex items-center flex-col cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#e3e3e3" class="fill-red-500">
                <path
                    d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
            </svg>
            <span class="text-xs">
                Anuluj
            </span>
        </button>
    @endif
</div>
