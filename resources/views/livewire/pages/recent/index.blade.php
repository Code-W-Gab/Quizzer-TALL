<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="flex justify-center">
    <div class="p-6 space-y-6 w-350">
        <header>
            <div class="space-y-2">
                <h1 class="text-2xl font-bold">Recent Quiz</h1>
                <span class="text-gray-500">Your last 4 quiz attempts</span>
            </div>
        </header>

        <div>
            <div class="bg-white p-4 rounded-xl flex items-center justify-between ">
                <div class="flex items-center gap-4">
                    <div>
                        <x-progress-circle :percentage="75" class="size-16"/>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-800">Advanced SQL Queries</h1>
                        <div class="text-gray-500 flex items-center gap-3">
                            <span>Aug 2, 2026</span>
                            <x-lucide-dot class="size-5"/>
                            <span>17/20 correct</span>
                            <x-lucide-dot class="size-5"/>
                            <div class="flex items-center gap-1">
                                <x-lucide-timer class="size-4"/>
                                <span>8m 32s</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="bg-gray-100 border border-gray-300 py-2 px-6 text-semibold rounded-lg">Review</button>
                    <button class="bg-blue-500 text-white py-2 px-6 text-semibold rounded-lg">Retake</button>
                </div>
            </div>
        </div>
    </div>


</div>
