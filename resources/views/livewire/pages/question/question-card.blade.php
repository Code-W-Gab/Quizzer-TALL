<div class="flex flex-col gap-3">
    @foreach ($folder->questions as $question)
        <div class="bg-white py-3 px-4 rounded-xl border border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-200 text-gray-900 size-9 rounded-lg flex items-center justify-center">1</div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-semibold">What is the time complexity of binary search?</h3>
                        <span class="bg-blue-50 text-blue-700 rounded-xl px-3 py-0.5 w-fit text-sm truncate">Multiple choice</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="text-gray-600 bg-gray-200 p-2 rounded-lg cursor-pointer hover:bg-gray-300"
                    >
                        <x-lucide-square-pen class="size-4"/>
                    </button>
                    <button
                        class="text-red-500 bg-gray-200 p-2 rounded-lg cursor-pointer hover:bg-gray-300"
                    >
                        <x-lucide-trash class="size-4"/>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
