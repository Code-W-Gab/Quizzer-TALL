<?php

namespace App\Livewire\Pages\Folder;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $deleteFolderName;
    public $deleteFolderId;
    public $editFolderId;
    public $name = '';
    public $description = '';
    public $term = '';

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function openEditModal(Folder $folder)
    {
        $this->name = $folder->name;
        $this->description = $folder->description;
        $this->editFolderId = $folder->id;

        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
    }

    public function openDeleteModal(Folder $folder)
    {
        $this->deleteFolderName = $folder->name;
        $this->deleteFolderId = $folder->id;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteFolderName = null;
        $this->showDeleteModal = false;
    }
    public function resetForm()
    {
        $this->reset([
            'name',
            'description'
        ]);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ];
    }

    public function save()
    {
        $validated = $this->validate($this->rules());

        $validated['user_id'] = Auth::id();

        Folder::create($validated);

        $this->showCreateModal = false;
        $this->resetForm();

        $this->redirect('/quiz-folder', navigate:true);
    }

    public function update()
    {
        $this->validate($this->rules());

        $folder = Folder::findOrFail($this->editFolderId);

        $folder->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->showEditModal = false;
        $this->resetForm();
    }

    public function delete()
    {
        Folder::findOrFail($this->deleteFolderId)->delete();

        $this->showDeleteModal = false;

        $this->redirect('/quiz-folder', navigate:true);
    }
    public function render()
    {
        if ($this->term){
            return view('livewire.pages.folder.index', [
                'folders' => Folder::where('name', 'LIKE', "%{$this->term}%")->get()
            ]);
        };

        return view('livewire.pages.folder.index', [
            'folders' => Folder::with(['questions.choices', 'questions.answers'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get()
        ]);
    }
}
