<?php

namespace App\Livewire\Pages\Folder;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $showCreateModal = false;
    public $name = '';
    public $description = '';

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description'
        ]);
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        $validated['user_id'] = Auth::id();

        Folder::create($validated);

        $this->showCreateModal = false;
        $this->resetForm();

        $this->redirect('/quiz-folder', navigate:true);
    }

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
