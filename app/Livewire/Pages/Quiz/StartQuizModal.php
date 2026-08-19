<?php

namespace App\Livewire\Pages\Quiz;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StartQuizModal extends Component
{

    public $showStartQuizModal = false;
    public function openStartQuizModal()
    {
        $this->showStartQuizModal = true;
    }

    public function render()
    {
        $folders = Folder::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.pages.quiz.start-quiz-modal', [
            'folders' => $folders
        ]);
    }
}
