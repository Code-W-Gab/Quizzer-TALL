<?php

use Livewire\Volt\Component;
use App\Models\Folder;
use App\Models\Question;
use Illuminate\Validation\Rule;

new class extends Component {
    public $showStartQuizModal = false;
    public array $selectedFolders = [];

    public function startQuiz()
    {
        $this->validate([
            'selectedFolders' => ['required', 'array', 'min:1'],
            'selectedFolders.*' => [
                'integer',
                Rule::exists('folders', 'id')
                    ->where('user_id', Auth::id()),
            ],
        ]);

        $questionIds = Question::whereIn('folder_id', $this->selectedFolders)
            ->inRandomOrder()
            ->pluck('id')
            ->values()
            ->all();

        if (count($questionIds) === 0) {
            $this->addError(
                'selectedFolders',
                'The selected folders do not contain any questions.'
            );

            return;
        }

        session([
            'quiz_folder_ids' => $this->selectedFolders,
            'quiz_question_ids' => $questionIds,
        ]);

        $this->redirectRoute('quiz');
    }

    public function openStartQuizModal()
    {
        $this->showStartQuizModal = true;
    }

    public function render(): mixed
    {
        $folders = Folder::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.pages.quiz.start-quiz', [
            'folders' => $folders
        ]);
    }
}; ?>

<div class="flex justify-center">
    <div class="bg-white rounded-xl w-200 my-6">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-900">Quiz Setup</h2>
            <p class="text-gray-500">Configure your quiz session before you start.</p>
        </div>

        <div class="border-b border-gray-300"></div>

        <div class="p-6 space-y-6">
            <div class="flex flex-col gap-4">
                <h1 class="font-bold">Select Folders</h1>
                @foreach ($folders as $folder)
                    <div class="flex items-center gap-3 border border-gray-300 py-3 px-6 rounded-lg">
                        <input
                            type="checkbox"
                            wire:model='selectedFolders'
                            value="{{ $folder->id }}"
                            class="rounded-sm"
                        >
                        <h3 class="font-medium">{{ $folder->name }}</h3>
                    </div>
                @endforeach
            </div>
            @error('selectedFolders')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('quiz-folder') }}" class="text-center border border-gray-300 bg-gray-100 py-3 rounded-lg font-semibold">Cancel</a>
                <button wire:click='startQuiz' class="bg-blue-500 text-white py-3 rounded-lg font-semibold">Start Quiz</button>
            </div>
        </div>
    </div>
</div>

