<div
    x-show="$wire.showDeleteQuestionModal"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
    <div class="bg-white rounded-xl p-6 w-full max-w-lg">
        <h2 class="text-xl font-medium text-gray-900">Delete this question?</h2>

        <p class="mt-3">
            Are you sure you want to delete this question?
        </p>

        <div class="mt-6 flex justify-end gap-3">
            <button
                type="button"
                wire:click="closeDeleteQuestionModal"
                class="bg-gray-200 border border-gray-300 font-semibold px-4 py-2 rounded-xl"
            >
                Cancel
            </button>

            <button
                type="button"
                wire:click='deleteQuestion'
                class="bg-red-500 text-white font-semibold px-4 py-2 rounded-xl"
            >
                Delete Folder
            </button>
        </div>
    </div>
</div>
