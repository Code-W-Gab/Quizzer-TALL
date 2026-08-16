<?php

namespace App\Livewire\Pages\Folder;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizFolder extends Component
{
    public $folders;
    public $deleteFolderId;
    public $deleteFolderName;
    public $showDeleteModal = false;

    public function mount($folders = null)
    {
        $this->folders = $folders;
    }

    public function openDeleteModal($id)
    {
        $folder = Folder::findOrFail($id);

        $this->deleteFolderId = $folder->id;
        $this->deleteFolderName = $folder->name;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteFolderId = null;
        $this->deleteFolderName = null;
        $this->showDeleteModal = false;
    }

    public function deleteFolder()
    {
        if (! $this->deleteFolderId) {
            return;
        }

        Folder::findOrFail($this->deleteFolderId)->delete();

        $this->folders = Folder::where('user_id', Auth::id())
            ->latest()
            ->get();

        $this->closeDeleteModal();
    }

    public function render()
    {
        return view('livewire.pages.folder.quiz-folder');
    }
}
