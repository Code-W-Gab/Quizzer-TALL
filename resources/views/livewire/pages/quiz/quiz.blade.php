<?php

use Livewire\Volt\Component;
use App\Models\Question;

new class extends Component {
    public array $questionIds = [];
    public int $currentIndex = 0;
    public ?Question $currentQuestion = null;

    public function mount()
    {
        $this->questionIds = session('quiz_question_ids', []);

        if (empty($this->questionIds)) {
            $this->redirectRoute('quiz-folder');
            return;
        }

        $this->loadQuestion();
    }

    public function loadQuestion()
    {
        $this->currentQuestion = Question::with(['choices', 'answers'])
            ->findOrFail($this->questionIds[$this->currentIndex]);
    }
}; ?>

<div class="flex justify-center">
    <div class="mt-6 space-y-4">
        <div class="bg-white rounded-xl border border-gray-200 p-4 space-y-4 w-200">
            <div class="flex items-center justify-between gap-4">
                <div class="text-sm text-gray-500">
                    Question {{ $currentIndex + 1 }} of {{ count($questionIds) }}
                </div>
                <div class="bg-blue-50 text-blue-500 px-2 py-0.5 rounded-xl text-sm">multiple choices</div>
            </div>
            <x-progress-bar :value="75" />
        </div>

        <div class="w-200 space-y-4 bg-white rounded-xl border-gray-200 p-4">
            <h1 class="font-bold text-lg">
                {{ $currentQuestion->question_text }}
            </h1>
            {{-- Multiple Choice --}}
            <div class="hidden flex-col gap-3">
                <div class="flex items-center gap-3 border border-gray-200 bg-gray-100 px-6 py-2 rounded-xl ">
                    <span>A.</span>
                    <p>Sun</p>
                </div>
                <div class="flex items-center gap-3 border border-gray-200 bg-gray-100 px-6 py-2 rounded-xl ">
                    <span>B.</span>
                    <p>Sun</p>
                </div>
                <div class="flex items-center gap-3 border border-gray-200 bg-gray-100 px-6 py-2 rounded-xl ">
                    <span>C.</span>
                    <p>Sun</p>
                </div>
                <div class="flex items-center gap-3 border border-gray-200 bg-gray-100 px-6 py-2 rounded-xl ">
                    <span>D.</span>
                    <p>Sun</p>
                </div>
            </div>

            {{-- True or False --}}
            <div class="hidden grid-cols-2 gap-3">
                <button class="border border-gray-200 bg-gray-100 rounded-xl p-3">True</button>
                <button class="border border-gray-200 bg-gray-100 rounded-xl p-3">False</button>
            </div>

            <div class="space-y-3">
                <input
                    type="text"
                    class="border border-gray-200 bg-gray-100 w-full rounded-xl h-11"
                    placeholder="Type your answer..."
                >
                <div class="flex justify-end">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-lg">Submit Answer</button>
                </div>
            </div>
        </div>

    </div>
</div>
