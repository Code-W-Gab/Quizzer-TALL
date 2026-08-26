<?php

namespace App\Livewire\Pages\Folder;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizFolder extends Component
{


    public function render()
    {
        return view('livewire.pages.folder.quiz-folder');
    }
}
