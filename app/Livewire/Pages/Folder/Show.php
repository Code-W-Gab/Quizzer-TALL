<?php

namespace App\Livewire\Pages\Folder;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Show extends Component
{
    public $folder;

    public $type = '';
    public $question = '';
    public $correctAnswer = '';
    public array $options = ['', '', '', ''];
    public ?int $correctOptionIndex = null;
    public ?string $trueFalseAnswer = null;

    public $showCreateQuestionModal = false;

    public function selectOption($index)
    {
        $this->correctOptionIndex = (int) $index;
    }

    public function selectTrueFalse(string $value)
    {
        $this->trueFalseAnswer = $value;
    }

    public function openCreateQuestionModal()
    {
        $this->showCreateQuestionModal = true;
    }

    public function closeCreateQuestionModal()
    {
        $this->showCreateQuestionModal = false;
        $this->resetQuestionForm();
    }

    public function resetQuestionForm()
    {
        $this->type = '';
        $this->question = '';
        $this->correctAnswer = '';
        $this->options = ['', '', '', ''];
        $this->correctOptionIndex = null;
        $this->trueFalseAnswer = null;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:multiple_choice,true_false,identification,enumeration',
            'question' => 'required|string|max:255',
            'correctAnswer' => 'required_if:type,identification|string|max:255',
            'trueFalseAnswer' => 'required_if:type,true_false|in:true,false',
            'options' => [
                ValidationRule::requiredIf($this->type === 'multiple_choice'),
                'array',
                'min:2',
                'max:4',
            ],
            'options.*' => [
                ValidationRule::requiredIf($this->type === 'multiple_choice'),
                'string',
                'max:255',
            ],
            'correctOptionIndex' => [
                ValidationRule::requiredIf($this->type === 'multiple_choice'),
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
                'exact_text' => $this->trueFalseAnswer, // 'true' or 'false'
            ]);
        }

        $this->closeCreateQuestionModal();
    }

    public function mount(int $id)
    {
        $this->folder = Folder::with(['questions.choices', 'questions.answers'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pages.folder.show', [
            'folder' => $this->folder,
        ]);
    }
}
