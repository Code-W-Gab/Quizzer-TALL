<?php

namespace App\Livewire\Pages\Folder;

use Livewire\Component;

class QuizFolder extends Component
{
    public $folders;

    public function mount($folders = null)
    {
        $this->folders = $folders;
    }

    public function render()
    {
        return view('livewire.pages.folder.quiz-folder');
    }
}
