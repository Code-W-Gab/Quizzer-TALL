<main class="flex justify-center">
    <div class="p-6 space-y-6 w-350">
        <header class="flex items-center justify-between">
            <div class="space-y-2">
                <h1 class="text-2xl font-bold">My Quiz Folders</h1>
                <span class="text-gray-500">6 folders - 254 questions total</span>
            </div>
            <button
                type="button"
                wire:click='openCreateModal'
                class="bg-blue-500 text-white py-2 px-3 rounded-lg flex items-center gap-2"
            >
                <span>Create Folder</span>
            </button>
        </header>
        <livewire:pages.folder.search-filter>
        @include('livewire.pages.folder.quiz-folder')
    </div>

    @include('livewire.pages.folder.create-folder-modal')
    @include('livewire.pages.folder.update-folder-modal')
    @include('livewire.pages.folder.delete-folder-modal')
</main>
