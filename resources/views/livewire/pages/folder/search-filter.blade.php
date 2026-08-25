<div class="flex items-center gap-4">
    <div class="flex items-center bg-white text-gray-400 px-4 rounded-xl border border-gray-300 w-150">
        <x-lucide-search class="size-5"/>
        <input
            type="text"
            name="folder"
            placeholder="Search folders..."
            wire:model.live.debounce.200ms='term'
            class="border-none outline-none ring-0 focus:outline-none focus:ring-0 text-gray-600 w-full"
        >
    </div>
    <select name="sort" class="border border-gray-300 px-4 rounded-xl w-40 focus:outline-none focus:ring-0">
        <option value="Newest">Sort: Newest</option>
        <option value="Oldest">Sort: Oldest</option>
        <option value="Newest">Sort: A-Z</option>
    </select>
</div>
