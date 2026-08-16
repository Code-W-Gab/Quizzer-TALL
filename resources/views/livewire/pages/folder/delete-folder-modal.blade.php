<div
    x-show="$wire.showDeleteModal"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
    <div class="bg-white rounded-xl p-6 w-full max-w-lg">
        <h2 class="text-xl font-medium text-gray-900">Delete this folder?</h2>

        <p class="mt-3">
            Are you sure you want to delete your
            <span class="font-bold">{{ $deleteFolderName }}</span>
            folder?
        </p>

        <div class="mt-6 flex justify-end gap-3">
            <button
                type="button"
                wire:click="closeDeleteModal"
                class="bg-gray-200 border border-gray-300 font-semibold px-4 py-2 rounded-xl"
            >
                Cancel
            </button>

            <button
                type="button"
                wire:click="delete"
                class="bg-red-500 text-white font-semibold px-4 py-2 rounded-xl"
            >
                Delete Folder
            </button>
        </div>
    </div>
</div>
