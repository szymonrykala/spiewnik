<div class="flex justify-between container mx-auto items-center">
    <div class="flex items-center p-2 gap-2 text-2xl decor-regular">
        <span class="text-5xl text-orange-700">♬</span>
        Śpiewnik
    </div>

    <div></div>
</div>

<?php
$nav_item = 'rounded-xl px-4 py-2 hover:bg-orange-700/40 transition-colors group hover:text-orange-100';
$nav_item_a = 'flex flex-col items-center';
$nav_item_svg = 'fill-orange-700 group-hover:scale-115 transition-transform';
?>

<nav class="fixed bottom-5 right-5">

    <ul class="bg-gray-200 flex gap-1 rounded-xl p-1 shadow-xl border-orange-900/10">

        <li class="{{ $nav_item }}">
            <a href="/performances" wire:navigate class="{{ $nav_item_a }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    class="{{ $nav_item_svg }}">
                    <path
                        d="M711-480Zm209 80H737q-3-21-9.5-41T711-480h126q-4-7-9-12t-12-9q-26-15-59.5-22t-76.5-7h-3q-20-23-43.5-40T582-599q23-5 47.5-8t50.5-3q53 0 99 11t86 32q26 14 40.5 41.5T920-463v63ZM680-640q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T720-760q0-17-11.5-28.5T680-800q-17 0-28.5 11.5T640-760q0 17 11.5 28.5T680-720Zm0-40ZM249-480ZM40-400v-63q0-35 14.5-62.5T95-567q40-21 86-32t99-11q26 0 50.5 3t47.5 8q-28 12-51.5 29T283-530h-3q-43 0-76.5 7T144-501q-7 4-12 9t-9 12h126q-10 19-16.5 39t-9.5 41H40Zm240-240q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T320-760q0-17-11.5-28.5T280-800q-17 0-28.5 11.5T240-760q0 17 11.5 28.5T280-720Zm0-40Zm200 480q-33 0-56.5-23.5T400-360v-120q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480v120q0 33-23.5 56.5T480-280ZM450-80v-82q-72-11-121-67t-49-131h60q0 58 41 99t99 41q58 0 99-41t41-99h60q0 75-49 131t-121 67v82h-60Z" />
                </svg>
                <span class="text-xs">
                    Występy
                </span>
            </a>
        </li>
        <li class="{{ $nav_item }}">
            <a href="/songs/search" wire:naviagate class="{{ $nav_item_a }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    class="{{ $nav_item_svg }}">
                    <path
                        d="M127-167q-47-47-47-113t47-113q47-47 113-47 23 0 42.5 5.5T320-418v-342l480-80v480q0 66-47 113t-113 47q-66 0-113-47t-47-113q0-66 47-113t113-47q23 0 42.5 5.5T720-498v-165l-320 63v320q0 66-47 113t-113 47q-66 0-113-47Z" />
                </svg>
                <span class="text-xs">
                    Piosenki
                </span>
            </a>
        </li>
        <li class="{{ $nav_item }}">
            <a href="/logout" wire:naviagate class="{{ $nav_item_a }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    class="{{ $nav_item_svg }}">
                    <path
                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                </svg>
                <span class="text-xs">
                    wyloguj
                </span>
            </a>
        </li>
    </ul>

</nav>
