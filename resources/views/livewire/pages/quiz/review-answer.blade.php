<?php

use Livewire\Volt\Component;

new class extends Component {
    public array $reviewAnswers = [];

    public function mount()
    {
        $this->reviewAnswers = session('quiz_review_answers', []);
    }

}; ?>

<div class="flex justify-center items-center">
    <div class="w-200 my-6">
        <div class="flex items-center justify-between gap-3">
            <h1 class="text-xl font-semibold">Review Answer</h1>
            <a href="result" class="flex items-center gap-2">
                <x-lucide-arrow-left class="size-4"/>
                <span>Back to Results</span>
            </a>
        </div>
        <div class="my-6 space-y-3">
            @foreach ($reviewAnswers as $answer)
                <div @class([
                    'space-y-3 p-4 rounded-xl border',
                    'bg-green-50 border-green-500' => $answer['is_correct'],
                    'bg-red-50 border-red-500' => ! $answer['is_correct'],
                ])>
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="font-semibold text-gray-500">
                            Q{{ $loop->iteration }}
                        </h2>

                        <span @class([
                            'text-sm',
                            'text-green-500' => $answer['is_correct'],
                            'text-red-500' => ! $answer['is_correct'],
                        ])>
                            {{ $answer['is_correct'] ? 'Correct' : 'Wrong' }}
                        </span>
                    </div>

                    <h2 class="text-lg font-semibold">
                        {{ $answer['question'] }}
                    </h2>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="border border-gray-200 bg-white py-3 px-5 rounded-xl space-y-1">
                            <h3 class="text-gray-500 text-xs">YOUR ANSWER</h3>
                            <span>{{ $answer['user_answer'] }}</span>
                        </div>

                        <div class="border border-gray-200 bg-white py-3 px-5 rounded-xl space-y-1">
                            <h3 class="text-gray-500 text-xs">CORRECT ANSWER</h3>
                            <span class="text-green-500">
                                {{ $answer['correct_answer'] }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
