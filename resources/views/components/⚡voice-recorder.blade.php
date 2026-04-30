<?php

use Livewire\Component;

new class extends Component {
    public bool $showRecorder = false;

    public function toggleRecorder()
    {
        $this->showRecorder = !$this->showRecorder;
    }

    public function saveRecording() {}
};
?>
<div>

    <button wire:click="toggleRecorder"
        class="bg-orange-700 size-12 rounded-md flex justify-center items-center cursor-pointer active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#e3e3e3">
            <path
                d="M403.67-447.61q-31-32.28-31-78.39v-247.33q0-44.45 31.29-75.56 31.3-31.11 76-31.11 44.71 0 76.04 31.11 31.33 31.11 31.33 75.56V-526q0 46.11-31 78.39T480-415.33q-45.33 0-76.33-32.28ZM480-647.33ZM446.67-120v-131.67q-105.34-12-176-90.33Q200-420.33 200-526h66.67q0 88.33 62.36 149.17Q391.38-316 479.86-316q88.47 0 150.97-60.83 62.5-60.84 62.5-149.17H760q0 105.67-70.67 184-70.66 78.33-176 90.33V-120h-66.66Zm62.5-374.83q11.5-12.84 11.5-31.17v-247.33q0-17-11.69-28.5-11.7-11.5-28.98-11.5t-28.98 11.5q-11.69 11.5-11.69 28.5V-526q0 18.33 11.5 31.17Q462.33-482 480-482t29.17-12.83Z" />
        </svg>
    </button>


    <div wire:show="showRecorder"
        class="fixed z-50 top-0 left-0 bg-gray-300/70 backdrop-blur-sm w-full h-dvh flex justify-center items-center">
        <div class="bg-gray-200 p-10 rounded-md relative shadow-lg">

            <button wire:click="toggleRecorder"
                class="absolute top-2 right-2 bg-gray-200 rounded-md hover:bg-gray-300 cursor-pointer active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                    fill="#e3e3e3" class="fill-orange-700">
                    <path
                        d="m251.33-204.67-46.66-46.66L433.33-480 204.67-708.67l46.66-46.66L480-526.67l228.67-228.66 46.66 46.66L526.67-480l228.66 228.67-46.66 46.66L480-433.33 251.33-204.67Z" />
                </svg>
            </button>


            <h2 class="decor-regular text-4xl mb-5 text-center">Nagrywanie</h2>
            <div class="flex flex-col items-center gap-5">
                <div class="text-5xl bg-orange-700 size-21 rounded-4xl flex justify-center items-center">
                    <button id="start-recording" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" height="64px" viewBox="0 -960 960 960" width="64px"
                            fill="#e3e3e3">
                            <path
                                d="M403.67-447.61q-31-32.28-31-78.39v-247.33q0-44.45 31.29-75.56 31.3-31.11 76-31.11 44.71 0 76.04 31.11 31.33 31.11 31.33 75.56V-526q0 46.11-31 78.39T480-415.33q-45.33 0-76.33-32.28ZM480-647.33ZM446.67-120v-131.67q-105.34-12-176-90.33Q200-420.33 200-526h66.67q0 88.33 62.36 149.17Q391.38-316 479.86-316q88.47 0 150.97-60.83 62.5-60.84 62.5-149.17H760q0 105.67-70.67 184-70.66 78.33-176 90.33V-120h-66.66Zm62.5-374.83q11.5-12.84 11.5-31.17v-247.33q0-17-11.69-28.5-11.7-11.5-28.98-11.5t-28.98 11.5q-11.69 11.5-11.69 28.5V-526q0 18.33 11.5 31.17Q462.33-482 480-482t29.17-12.83Z" />
                        </svg>
                    </button>
                    <button id="stop-recording" class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" height="64px" viewBox="0 -960 960 960" width="64px"
                            fill="#e3e3e3">
                            <path
                                d="M326.67-326.67h306.66v-306.66H326.67v306.66ZM480.18-80q-82.83 0-155.67-31.5-72.84-31.5-127.18-85.83Q143-251.67 111.5-324.56T80-480.33q0-82.88 31.5-155.78Q143-709 197.33-763q54.34-54 127.23-85.5T480.33-880q82.88 0 155.78 31.5Q709-817 763-763t85.5 127Q880-563 880-480.18q0 82.83-31.5 155.67Q817-251.67 763-197.46q-54 54.21-127 85.84Q563-80 480.18-80Zm.15-66.67q139 0 236-97.33t97-236.33q0-139-96.87-236-96.88-97-236.46-97-138.67 0-236 96.87-97.33 96.88-97.33 236.46 0 138.67 97.33 236 97.33 97.33 236.33 97.33ZM480-480Z" />
                        </svg>
                    </button>
                </div>
                <audio controls class="bg-orange-500 rounded-md">
                    <source src="" type="audio/wav">
                    Your browser does not support the audio element.
                </audio>

                <div class="flex gap-4 w-full">
                    <button class="flex justify-center bg-red-600/80 p-3 rounded-md w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#e3e3e3">
                            <path
                                d="M267.33-120q-27.5 0-47.08-19.58-19.58-19.59-19.58-47.09V-740H160v-66.67h192V-840h256v33.33h192V-740h-40.67v553.33q0 27-19.83 46.84Q719.67-120 692.67-120H267.33Zm425.34-620H267.33v553.33h425.34V-740Zm-328 469.33h66.66v-386h-66.66v386Zm164 0h66.66v-386h-66.66v386ZM267.33-740v553.33V-740Z" />
                        </svg>
                    </button>
                    <button class="w-full flex justify-center bg-green-700/90 p-3 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#e3e3e3">
                            <path
                                d="M840-682v495.33q0 27-19.83 46.84Q800.33-120 773.33-120H186.67q-27 0-46.84-19.83Q120-159.67 120-186.67v-586.66q0-27 19.83-46.84Q159.67-840 186.67-840H682l158 158Zm-66.67 29.33L652.67-773.33h-466v586.66h586.66v-466Zm-216 377.49q32-31.84 32-77.33 0-45.49-31.84-77.49-31.84-32-77.33-32-45.49 0-77.49 31.84-32 31.85-32 77.34t31.84 77.49q31.84 32 77.33 32 45.49 0 77.49-31.85ZM235.33-576H594v-148.67H235.33V-576Zm-48.66-76.67v466-586.66 120.66Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
