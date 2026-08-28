<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Folder;
use App\Models\Question;

new class extends Component {
    use WithPagination;

    public $folder;

    public $type = '';
    public $question = '';
    public $identificationAnswer = '';
    public array $options = ['', '', '', ''];
    public ?int $correctOptionIndex = null;
    public ?string $trueFalseAnswer = null;
    public int $deleteQuestionId;
    public int $editQuestionId;
    public $showCreateQuestionModal = false;
    public $showDeleteQuestionModal = false;
    public $showEditQuestionModal = false;

    public function openCreateQuestionModal()
    {
        $this->showCreateQuestionModal = true;
    }

    public function closeCreateQuestionModal()
    {
        $this->showCreateQuestionModal = false;
        $this->resetQuestionForm();
    }

    public function openDeleteQuestionModal(int $id)
    {
        $this->showDeleteQuestionModal = true;
        $this->deleteQuestionId = $id;
    }

    public function closeDeleteQuestionModal()
    {
        $this->showDeleteQuestionModal = false;
    }

    public function openEditQuestionModal(int $id)
    {
        $question = Question::where('folder_id', $this->folder->id)
            ->with(['answers', 'choices'])
            ->findOrFail($id);

        $this->editQuestionId = $question->id;
        $this->type = $question->type;
        $this->question = $question->question_text;

        $this->identificationAnswer = '';
        $this->options = ['', '', '', ''];
        $this->correctOptionIndex = null;
        $this->trueFalseAnswer = null;

        if ($question->type === 'identification'){
            $this->identificationAnswer = $question->answers()->value('exact_text');
        }

        if ($question->type === 'true_false'){
            $this->trueFalseAnswer = $question->answers()->value('exact_text');
        }

        if ($question->type === 'multiple_choice') {
            $choices = $question->choices()->pluck('choice_text')->toArray();
            $this->options = array_pad($choices, 4, '');

            $correctAnswer = $question->answers()->first();

            if ($correctAnswer && $correctAnswer->choice_id) {
                $correctChoiceId = $correctAnswer->choice_id;
                $this->correctOptionIndex = $question->choices()->pluck('id')->search($correctChoiceId);
            }
        }
        $this->showEditQuestionModal = true;
    }

    public function closeEditQuestionModal()
    {
        $this->showEditQuestionModal = false;
        $this->resetQuestionForm();
    }

    public function selectOption($index)
    {
        $this->correctOptionIndex = (int) $index;
    }

    public function selectTrueFalse(string $value)
    {
        $this->trueFalseAnswer = $value;
    }

    public function resetQuestionForm()
    {
        $this->type = '';
        $this->question = '';
        $this->identificationAnswer = '';
        $this->options = ['', '', '', ''];
        $this->correctOptionIndex = null;
        $this->trueFalseAnswer = null;
    }

    public function rules()
    {
        return [
            'type' => ['required', 'in:multiple_choice,true_false,identification,enumeration'],
            'question' => ['required', 'string', 'max:255'],

            'identificationAnswer' => [
                'required_if:type,identification',
                'nullable',
                'string',
                'max:255',
            ],

            'trueFalseAnswer' => [
                'required_if:type,true_false',
                'nullable',
                'in:true,false',
            ],

            'options' => [
                'required_if:type,multiple_choice',
                'array',
                'min:2',
                'max:4',
            ],

            'options.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'correctOptionIndex' => [
                'required_if:type,multiple_choice',
                'nullable',
                'integer',
                'min:0',
                'max:3',
            ],
        ];
    }


    public function saveQuestion()
    {
        $validated = $this->validate();

        if ($this->type === 'multiple_choice') {
            $filteredOptions = array_values(array_filter(
                $this->options,
                fn ($option) => trim($option) !== ''
            ));

            if (count($filteredOptions) < 2) {
                $this->addError('options', 'Please provide at least 2 options.');
                return;
            }

            if ($this->correctOptionIndex === null) {
                $this->addError('correctOptionIndex', 'Please select the correct answer.');
                return;
            }

            if ($this->correctOptionIndex >= count($filteredOptions)) {
                $this->addError('correctOptionIndex', 'The selected correct answer is invalid.');
                return;
            }
        }

        if ($this->type === 'true_false' && $this->trueFalseAnswer === null) {
            $this->addError('trueFalseAnswer', 'Please choose True or False.');
            return;
        }



        $question = $this->folder->questions()->create([
            'type' => $validated['type'],
            'question_text' => $validated['question'],
        ]);

        if ($this->type === 'multiple_choice') {
            $filteredOptions = array_values(array_filter(
                $this->options,
                fn ($option) => trim($option) !== ''
            ));

            foreach ($filteredOptions as $index => $optionText) {
                $choice = $question->choices()->create([
                    'choice_text' => $optionText,
                ]);

                if ($index === $this->correctOptionIndex) {
                    $question->answers()->create([
                        'choice_id' => $choice->id,
                        'exact_text' => null,
                    ]);
                }
            }
        }

        if ($this->type === 'true_false') {
            $question->answers()->create([
                'choice_id' => null,
                'exact_text' => $this->trueFalseAnswer,
            ]);
        }

        if ($this->type === 'identification') {
            $question->answers()->create([
                'choice_id' => null,
                'exact_text' => $this->identificationAnswer,
            ]);
        }

        $this->closeCreateQuestionModal();
    }

    public function updateQuestion()
    {
        $validated = $this->validate();

        $question = Question::findOrFail($this->editQuestionId);

        if ($this->type === 'multiple_choice') {
            $filteredOptions = array_values(array_filter(
                $this->options,
                fn ($option) => trim((string) $option) !== ''
            ));

            if (count($filteredOptions) < 2) {
                $this->addError('options', 'Please provide at least 2 options.');
                return;
            }

            if ($this->correctOptionIndex === null) {
                $this->addError('correctOptionIndex', 'Please select the correct answer.');
                return;
            }

            if ($this->correctOptionIndex >= count($filteredOptions)) {
                $this->addError('correctOptionIndex', 'The selected correct answer is invalid.');
                return;
            }
        }

        if ($this->type === 'true_false' && $this->trueFalseAnswer === null) {
            $this->addError('trueFalseAnswer', 'Please choose True or False.');
            return;
        }

        if ($this->type === 'identification' && trim((string) $this->identificationAnswer) === '') {
            $this->addError('identificationAnswer', 'Please enter the correct answer.');
            return;
        }

        $question->update([
            'type' => $validated['type'],
            'question_text' => $validated['question'],
        ]);

        $question->answers()->delete();
        $question->choices()->delete();

        if ($this->type === 'multiple_choice') {
            $filteredOptions = array_values(array_filter(
                $this->options,
                fn ($option) => trim((string) $option) !== ''
            ));

            foreach ($filteredOptions as $index => $optionText) {
                $choice = $question->choices()->create([
                    'choice_text' => $optionText,
                ]);

                if ($index === $this->correctOptionIndex) {
                    $question->answers()->create([
                        'choice_id' => $choice->id,
                        'exact_text' => null,
                    ]);
                }
            }
        }

        if ($this->type === 'true_false') {
            $question->answers()->create([
                'choice_id' => null,
                'exact_text' => $this->trueFalseAnswer,
            ]);
        }

        if ($this->type === 'identification') {
            $question->answers()->create([
                'choice_id' => null,
                'exact_text' => $this->identificationAnswer,
            ]);
        }

        $this->closeEditQuestionModal();
    }

    public function deleteQuestion()
    {
        $question = Question::findOrFail($this->deleteQuestionId);

        $question->delete();
        $question->answers()->delete();
        $question->choices()->delete();

        $this->showDeleteQuestionModal = false;
    }

    public function mount(int $id)
    {
        $this->folder = Folder::where('user_id', Auth::id())
            ->findOrFail($id);
    }

    public function render(): mixed
    {
        $questions = $this->folder->questions()
            ->with(['choices', 'answers'])
            ->latest()
            ->paginate(5);

        return view('livewire.pages.folder.show', [
            'folder' => $this->folder,
            'questions' => $questions
        ]);
    }
}; ?>

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
                <a href="{{ route('start-quiz') }}" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600">Start Quiz</a>
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
