<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="flex justify-center">
    <div class="p-6 space-y-6 w-350">
        <header class="flex items-center justify-between">
            <div class="space-y-2">
                <h1 class="text-2xl font-bold">Shared With Me</h1>
                <span class="text-gray-500">3 folders shared with you</span>
            </div>
            <button
                type="button"
                wire:click="openCreateModal"
                class="bg-blue-500 text-white py-2 px-3 rounded-lg flex items-center gap-2"
            >
                <x-lucide-plus class="size-4"/>
                <span>Import Folder</span>
            </button>
        </header>

        <div>
            <div class="bg-white p-4 rounded-xl flex items-center justify-between ">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 text-blue-500 p-3 rounded-lg">
                        <x-lucide-folder class="size-7"/>
                    </div>
                    <div class="space-y-1">
                        <h1 class="text-xl font-bold">Advanced SQL Queries</h1>
                        <div class="text-sm text-gray-500">
                            by Maria Santos
                            ·
                            Database
                            ·
                            34 questions
                            ·
                            Jul 28, 2025
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="bg-blue-500 text-white py-2 px-6 text-semibold rounded-lg">Practice</button>
                    <button class="bg-gray-100 border border-gray-300 py-2 px-6 text-semibold rounded-lg">View</button>
                </div>
            </div>
        </div>
    </div>
</div>
