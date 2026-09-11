<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="p-6 flex items-center justify-center ">
    <div class="bg-white rounded-xl border border-gray-200 w-150">
        <div class="space-y-2 p-6">
            <h1 class="text-2xl font-bold">Import Shared Folder</h1>
            <p class="text-gray-500">Enter a share code to preview and import a quiz folder</p>
        </div>
        <div class="border-b border-gray-300"></div>
        <div class="p-6">
            <label for="share-code" class="text-gray-800 font-semibold">
                Share Code
            </label>
            <div class="flex items-center gap-4 mt-2">
                <input
                    type="text"
                    name="share-code"
                    placeholder="e.g.  QZ-8KPL-92MD"
                    class="bg-gray-200 border-gray-300 w-full rounded-lg px-4"
                >
                <button class="bg-blue-500 text-white hover:bg-blue-600 px-6 py-2 rounded-lg w-40">Import</button>
            </div>
        </div>
    </div>
</div>
