<div class="space-y-5">
    <div class="flex flex-col gap-1">
        <label for="name" class="font-semibold text-gray-900 text-sm">Folder Name</label>
        <input
            type="text"
            placeholder="e.g., Java Fundamentals"
            wire:model="name"
            class="rounded-lg border border-gray-200 bg-gray-100"
        >
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="flex flex-col gap-1">
        <label for="description" class="font-semibold text-gray-900 text-sm">
            Description
            <span class="text-gray-400 text-xs">(Optional)</span>
        </label>
        <textarea
            name="description"
            wire:model='description'
            rows="4"
            placeholder="Brief description of what this folder covers..."
            class="rounded-lg border border-gray-200 bg-gray-100"
        ></textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
</div>
