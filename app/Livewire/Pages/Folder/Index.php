<?php

namespace App\Livewire\Pages\Folder;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{


    public function render()
    {
        return view('livewire.pages.folder.index', [
            'folders' => Folder::with(['questions.choices', 'questions.answers'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get()
        ]);
    }
}
