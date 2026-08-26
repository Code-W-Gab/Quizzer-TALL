<div
        x-show="$wire.showEditModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div class="bg-white rounded-xl p-6 w-full max-w-lg space-y-6">
            <h2 class="text-xl font-bold text-gray-900">Update Folder</h2>

            @include('livewire.pages.folder.form')

            <div class="grid grid-cols-2 gap-4">
                <button
                    type="button"
                    wire:click='closeEditModal'
                    class="bg-gray-200 border border-gray-300 font-semibold py-2 rounded-xl hover:bg-gray-300 cursor-pointer"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    wire:click='update'
                    class="bg-blue-500 text-white font-semibold py-2 rounded-xl hover:bg-blue-600 cursor-pointer"
                >
                    Update Folder
                </button>
            </div>
        </div>
    </div>
