<?php

namespace App\Livewire\Pages\Folder;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $folder;
    public function mount(int $id)
    {
        $this->folder = Folder::with(['questions.choices', 'questions.answers'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.pages.folder.show', [
            'folder' => $this->folder
        ]);
    }
}
