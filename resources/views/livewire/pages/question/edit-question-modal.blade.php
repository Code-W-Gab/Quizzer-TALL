<div
    x-show="$wire.showEditQuestionModal"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
    <div
        class="bg-white rounded-xl p-6 w-full max-w-lg space-y-6"
    >
        <h2 class="text-xl font-bold text-gray-900">Update Question</h2>

        <div class="flex flex-col gap-2">
            <label for="type" class="font-medium text-sm">
                Type:
            </label>
            <select
                name="type"
                wire:model='type'
                class="bg-gray-50 border border-gray-200 rounded-md"
            >
                <option value="">Select Type</option>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="true_false">True/False</option>
                <option value="identification">Identification</option>
                <option value="enumeration">Enumeration</option>
            </select>
        </div>

        <div wire:show='type' class="space-y-6">
            <div class="flex flex-col gap-1">
                <label for="question_text" class="font-semibold text-gray-900 text-sm">
                    Question
                </label>
                <textarea
                    wire:model='question'
                    placeholder="Enter your question..."
                    rows="4"
                    class="rounded-lg border border-gray-200 bg-gray-100"
                ></textarea>
                <x-input-error :messages="$errors->get('question')" class="mt-2" />
            </div>
            @include('livewire.pages.question.form')
        </div>

        <div class="grid grid-cols-2 gap-4">
            <button
                wire:click='closeEditQuestionModal'
                type="button"
                class="bg-gray-200 border border-gray-300 font-semibold py-2 rounded-xl hover:bg-gray-300 cursor-pointer"
            >
                Cancel
            </button>
            <button
                type="button"
                wire:click='updateQuestion'
                class="bg-blue-500 text-white font-semibold py-2 rounded-xl hover:bg-blue-600 cursor-pointer"
            >
                Update Question
            </button>
        </div>
    </div>
</div>
