<div class="p-6 flex justify-center">
    <div class="space-y-4 w-250">
        <div class="p-6 bg-white border border-gray-200 border-t-4 border-t-blue-500 rounded-xl space-y-4">
            <h1 class="text-2xl font-bold text-gray-900">{{ $folder->name }}</h1>
            <p class="text-gray-500">{{ $folder->description }}.</p>
            <div class="flex items-center gap-8">
                <div>
                    <h2 class="text-xl font-bold">{{ count($questions) }}</h2>
                    <span class="text-gray-500">Questions</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold">78%</h2>
                    <span class="text-gray-500">Avg. Score</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold">{{ $folder->created_at->format('F j, Y') }}</h2>
                    <span class="text-gray-500">Created</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600">Start Quiz</button>
                <button class="bg-gray-200 border border-gray-300 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300">Share</button>
            </div>
        </div>
        <div class="font-bold text-lg text-gray-900 px-2">Questions ({{ $questions->total() }})</div>
        {{-- All questions --}}
        @include('livewire.pages.question.question-card')
    </div>

    {{-- Add questions --}}
    <div class="absolute bottom-10 right-10">
        <button
            wire:click='openCreateQuestionModal'
            class="flex items-center gap-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-4xl cursor-pointer"
        >
            <x-lucide-plus class="size-4"/>
            Add Question
        </button>
    </div>

    @include('livewire.pages.question.create-question-modal')
</div>
