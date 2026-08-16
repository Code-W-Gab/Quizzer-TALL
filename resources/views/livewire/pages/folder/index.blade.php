<main class="flex justify-center">
    <div class="p-6 space-y-6 w-350">
        <header class="flex items-center justify-between">
            <div class="space-y-2">
                <h1 class="text-2xl font-bold">My Quiz Folders</h1>
                <span class="text-gray-500">6 folders - 254 questions total</span>
            </div>
            <button
                type="button"
                wire:click='openCreateModal'
                class="bg-blue-500 text-white py-2 px-3 rounded-lg flex items-center gap-2"
            >
                <span>Create Folder</span>
            </button>
        </header>
        <livewire:pages.folder.search-filter>
        <livewire:pages.folder.quiz-folder :folders="$folders" />
    </div>

    <div
        x-show="$wire.showCreateModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div class="bg-white rounded-xl p-6 w-full max-w-lg space-y-6">
            <h2 class="text-xl font-bold text-gray-900">Create Folder</h2>

            <div class="space-y-5">
                <div class="flex flex-col gap-1">
                    <label for="name" class="font-semibold text-gray-900 text-sm">Folder Name</label>
                    <input
                        type="text"
                        placeholder="e.g., Java Fundamentals"
                        wire:model="name"
                        class="rounded-lg border border-gray-200 bg-gray-100"
                    >
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-1">
                    <label for="description" class="font-semibold text-gray-900 text-sm">
                        Description
                        <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <textarea
                        name="description"
                        wire:model='description'
                        rows="4"
                        placeholder="Brief description of what this folder covers..."
                        class="rounded-lg border border-gray-200 bg-gray-100"
                    ></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>


            <div class="grid grid-cols-2 gap-4">
                <button
                    type="button"
                    wire:click='closeCreateModal'
                    class="bg-gray-200 border border-gray-300 font-semibold py-2 rounded-xl hover:bg-gray-300 cursor-pointer"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    wire:click='save'
                    class="bg-blue-500 text-white font-semibold py-2 rounded-xl hover:bg-blue-600 cursor-pointer"
                >
                    Create Folder
                </button>
            </div>
            </div>
        </div>
    </div>
</main>
