<?php

use Livewire\Volt\Component;

new class extends Component {
    //

}; ?>

<div class="flex justify-center items-center">
    <div class="w-200 my-6">
        <div class="flex items-center justify-between gap-3">
            <h1 class="text-xl font-semibold">Review Answer</h1>
            <a href="result">Back to Results</a>
        </div>
        <div class="my-6 space-y-3">
            <div class="space-y-3 bg-green-50 p-4 rounded-xl border border-green-500">
                <div class="flex items-center justify-between gap-4">
                    <h1 class="font-semibold text-gray-500">Q1</h1>
                    <span class="text-sm text-green-500">Correct</span>
                </div>
                <h1 class="text-lg font-semibold">What is the time complexity of binary search?</h1>
                <div class="grid grid-cols-2 gap-3">
                    <div class="border border-gray-200 bg-white py-3 px-5 rounded-xl space-y-1">
                        <h1 class="text-gray-500 text-xs">YOUR ANSWER</h1>
                        <span class="text-green-500 text-xl">0(n)</span>
                    </div>
                    <div class="border border-gray-200 bg-white py-3 px-5 rounded-xl space-y-1">
                        <h1 class="text-gray-500 text-xs">CORRECT ANSWER</h1>
                        <span class="text-green-500 text-xl">0(n)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
