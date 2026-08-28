<?php

use Livewire\Volt\Component;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

new class extends Component {
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
        $this->resetForm();
    }

    // EDIT MODAL
    public function openEditModal(int $folderId): void
    {
        $folder = Folder::where('user_id', Auth::id())->findOrFail($folderId);
        $this->name = $folder->name;
        $this->description = $folder->description;
        $this->editFolderId = $folder->id;
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->resetForm();
    }

    // DELETE MODAL
    public function openDeleteModal(int $folderId)
    {
        $folder = Folder::where('user_id', Auth::id())->findOrFail($folderId);
        $this->deleteFolderName = $folder->name;
        $this->deleteFolderId = $folder->id;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteFolderName = null;
        $this->showDeleteModal = false;
    }

    // RESET FORM
    public function resetForm()
    {
        $this->reset([
            'name',
            'description'
        ]);
    }

    // VALIDATION
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ];
    }

    // CREATE
    public function save()
    {
        $validated = $this->validate($this->rules());
        $validated['user_id'] = Auth::id();

        Folder::create($validated);

        $this->showCreateModal = false;
        $this->resetForm();
        $this->redirect('/quiz-folder', navigate:true);
    }

    // EDIT
    public function update()
    {
        $this->validate($this->rules());
        $folder = Folder::where('user_id', Auth::id())
            ->findOrFail($this->editFolderId);
        $folder->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->showEditModal = false;
        $this->resetForm();
    }

    // DELETE
    public function delete()
    {
        Folder::where('user_id', Auth::id())
            ->findOrFail($this->deleteFolderId)
            ->delete();

        $this->showDeleteModal = false;
        $this->redirect('/quiz-folder', navigate:true);
    }

    public function render(): mixed
    {
        if ($this->term) {
            return $this->view([
                'folders' => Folder::where('user_id', Auth::id())
                    ->where('name', 'LIKE', "%{$this->term}%")
                    ->latest()
                    ->get(),
            ]);
        }

        return view('livewire.pages.folder.index', [
            'folders' => Folder::with(['questions.choices', 'questions.answers'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get()
        ]);
    }

}; ?>

<div class="flex justify-center">
    <div class="p-6 space-y-6 w-350">
        <header class="flex items-center justify-between">
            <div class="space-y-2">
                <h1 class="text-2xl font-bold">My Quiz Folders</h1>
                <span class="text-gray-500">6 folders - 254 questions total</span>
            </div>
            <button
                type="button"
                wire:click="openCreateModal"
                class="bg-blue-500 text-white py-2 px-3 rounded-lg flex items-center gap-2"
            >
                <span>Create Folder</span>
            </button>
        </header>
        @include('livewire.pages.folder.search-filter')
        @include('livewire.pages.folder.quiz-folder')
    </div>

    @include('livewire.pages.folder.create-folder-modal')
    @include('livewire.pages.folder.update-folder-modal')
    @include('livewire.pages.folder.delete-folder-modal')
</div>
