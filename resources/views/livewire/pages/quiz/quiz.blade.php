<?php

use Livewire\Volt\Component;
use App\Models\Question;

new class extends Component {
    public array $questionIds = [];
    public int $currentIndex = 0;
    public ?Question $currentQuestion = null;
    public ?int $selectedChoiceId = null;
    public ?string $selectedTrueFalseAnswer = null;
    public bool $showResult = false;
    public int $score = 0;
    public ?string $correctAnswer = null;
    public ?int $correctChoiceId = null;

    public function mount()
    {
        $this->score = 0;
        $this->questionIds = session('quiz_question_ids', []);

        if (empty($this->questionIds)) {
            $this->redirectRoute('quiz-folder');
            return;
        }

        $this->loadQuestion();
    }

    public function loadQuestion()
    {
        $this->selectedChoiceId = null;
        $this->showResult = false;

        $this->currentQuestion = Question::with(['choices', 'answers'])
            ->findOrFail($this->questionIds[$this->currentIndex]);
    }

    // Multiple choice
    public function selectChoice(int $choiceId)
    {
        if ($this->showResult) {
            return;
        }

        $this->selectedChoiceId = $choiceId;

        $this->correctChoiceId = $this->currentQuestion->answers()->value('choice_id');

        if ((int) $choiceId === (int) $this->correctChoiceId){
            $this->score++;
        }

        $this->showResult = true;
    }

    // True or false
    public function selectTrueFalseAnswer(string $value)
    {
        if ($this->showResult) {
            return;
        }

        $this->selectedTrueFalseAnswer = $value;

        $this->correctAnswer = strtolower((string) $this->currentQuestion->answers()->value('exact_text'));

        if (strtolower($value) === $this->correctAnswer){
            $this->score++;
        }
        $this->showResult = true;
    }

    public function skipQuestion()
    {
        if (! isset($this->questionIds[$this->currentIndex + 1])) {
            $this->redirectRoute('quiz-folder');
            return;
        }

        $this->currentIndex++;
        $this->loadQuestion();
    }

    public function nextQuestion()
    {
        if (! $this->showResult) {
            $this->addError('answer', 'Please select an answer first.');
            return;
        }

        if (! isset($this->questionIds[$this->currentIndex + 1])) {
            $this->redirectRoute('quiz-folder');
            return;
        }

        $this->currentIndex++;
        $this->loadQuestion();
    }
}; ?>

<div class="flex justify-center">
    <div class="mt-6 space-y-4">
        <div class="bg-white rounded-xl border border-gray-200 p-4 space-y-4 w-200">
            <div class="flex items-center justify-between gap-4">
                <div class="text-sm text-gray-500">
                    Question {{ $currentIndex + 1 }} of {{ count($questionIds) }}
                </div>
                <div class="flex items-center gap-2">
                    <div class="bg-blue-50 text-blue-500 px-2 py-0.5 rounded-xl text-sm">
                        <span>{{ str($currentQuestion->type)->replace('_', ' ')->title() }}</span>
                    </div>
                    <div class="text-sm text-green-500 font-medium">
                        Score {{ $score }}/{{ count($questionIds) }}
                    </div>
                </div>
            </div>

            <x-progress-bar :value="$currentIndex + 1" :min="0" :max="count($questionIds)" />
        </div>

        <div class="w-200 space-y-4 bg-white rounded-xl border-gray-200 p-4">
            <h1 class="font-bold text-lg">
                {{ $currentQuestion->question_text }}
            </h1>

            @if ($currentQuestion && $currentQuestion->type === 'multiple_choice')
                <div class="flex flex-col gap-3">
                    @foreach ($currentQuestion->choices as $choice)
                        @php
                            $isCorrect = $showResult && $choice->id === $correctChoiceId;
                            $isWrong = $showResult && $selectedChoiceId === $choice->id && $choice->id !== $correctChoiceId;
                        @endphp

                        <button
                            type="button"
                            wire:click="selectChoice({{ $choice->id }})"
                            class="flex items-center gap-3 border px-6 py-2 rounded-xl text-left transition
                                {{ $isCorrect
                                    ? 'border-green-500 bg-green-50 text-green-700'
                                    : ($isWrong
                                        ? 'border-red-500 bg-red-50 text-red-700'
                                        : 'border-gray-200 bg-gray-100 text-gray-800') }}"
                        >
                            <span>{{ chr(65 + $loop->index) }}.</span>
                            <p>{{ $choice->choice_text }}</p>
                        </button>
                    @endforeach
                </div>
            @endif

            @if ($currentQuestion && $currentQuestion->type === 'true_false')
                @php
                    $selectedAnswer = strtolower((string) $selectedTrueFalseAnswer);

                    $trueIsCorrect = $showResult && $correctAnswer === 'true';
                    $falseIsCorrect = $showResult && $correctAnswer === 'false';

                    $trueIsWrong = $showResult && $selectedAnswer === 'true' && $correctAnswer !== 'true';
                    $falseIsWrong = $showResult && $selectedAnswer === 'false' && $correctAnswer !== 'false';
                @endphp

                <div class="grid grid-cols-2 gap-3">
                    <button
                        type="button"
                        wire:click='selectTrueFalseAnswer("true")'
                        class="border rounded-xl p-3 transition cursor-pointer hover:bg-gray-200
                            {{ $trueIsCorrect
                                ? 'border-green-500 bg-green-50 text-green-700'
                                : ($trueIsWrong
                                    ? 'border-red-500 bg-red-50 text-red-700'
                                    : 'border-gray-200 bg-gray-100 text-gray-800') }}"
                    >
                        True
                    </button>

                    <button
                        type="button"
                        wire:click='selectTrueFalseAnswer("false")'
                        class="border rounded-xl p-3 transition cursor-pointer hover:bg-gray-200
                            {{ $falseIsCorrect
                                ? 'border-green-500 bg-green-50 text-green-700'
                                : ($falseIsWrong
                                    ? 'border-red-500 bg-red-50 text-red-700'
                                    : 'border-gray-200 bg-gray-100 text-gray-800') }}"
                    >
                        False
                    </button>
                </div>
            @endif

            @if ($currentQuestion && $currentQuestion->type === 'identification')
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
            @endif

            @error('answer')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <button
                type="button"
                wire:click='skipQuestion'
                class="border border-gray-400 text-gray-700 px-10 py-2 rounded-md cursor-pointer hover:bg-gray-200"
            >
                Skip
            </button>
            <button
                type="button"
                wire:click="nextQuestion"
                class="bg-blue-500 text-white py-2 px-10 rounded-md cursor-pointer hover:bg-blue-600"
            >
                Next
            </button>
        </div>
    </div>
</div>
