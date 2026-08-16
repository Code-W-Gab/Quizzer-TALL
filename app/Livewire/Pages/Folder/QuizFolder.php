<?php

namespace App\Livewire\Pages\Folder;

use App\Models\Folder;
use Livewire\Component;

class QuizFolder extends Component
{
    public $folders;

    public function mount($folders = null)
    {
        $this->folders = $folders;
    }

    public function deleteFolder(Folder $folder)
    {
        $folder->delete();

        $this->redirect('/quiz-folder', navigate:true);
    }

    public function render()
    {
        return view('livewire.pages.folder.quiz-folder');
    }
}
