<?php

use Livewire\Volt\Component;

new class extends Component {
    public int $score = 0;
    public int $wrong = 0;
    public int $skip = 0;

    public function mount()
    {
        $result = session('quiz_result', [
            'score' => 0,
            'wrong' => 0,
            'skip' => 0
        ]);

        $this->score = ($result['score'] ?? 0);
        $this->wrong = ($result['wrong'] ?? 0);
        $this->skip = ($result['skip'] ?? 0);
    }

    public function reviewAnswer()
    {
        $this->redirectRoute('review-answer');
    }

}; ?>

<div class="flex justify-center items-center">
    <div class="bg-white rounded-xl border border-gray-200 p-4 space-y-4 w-200 my-6">
        <h1 class="text-center text-2xl font-bold">Quiz Complete!</h1>
        <div class="grid grid-cols-3 gap-3 text-center">
            <div class="border p-3 rounded-lg">
                <h1 class="text-3xl text-green-500 font-medium">{{ $score }}</h1>
                <span class="text-sm text-gray-500">Correct</span>
            </div>
            <div class="border p-3 rounded-lg">
                <h1 class="text-3xl text-red-500 font-medium">{{ $wrong }}</h1>
                <span class="text-sm text-gray-500">Wrong</span>
            </div>
            <div class="border p-3 rounded-lg">
                <h1 class="text-3xl text-gray-500 font-medium">{{ $skip }}</h1>
                <span class="text-sm text-gray-500">Skip</span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <button wire:click='reviewAnswer' class="rounded-xl border border-gray-300 bg-gray-100 text-gray-700 p-3 hover:bg-gray-200">Review Answers</button>
            <a href="{{ route('start-quiz') }}" class="text-center rounded-xl text-white bg-blue-500 p-3 hover:bg-blue-600">Retake Quiz</a>
        </div>
        <div class="flex items-center">
            <a href="{{ route('quiz-folder') }}" class="text-center w-full rounded-xl border border-gray-300 text-gray-700 p-3 hover:bg-gray-100">Back to Dashboard</a>
        </div>
    </div>
</div>
