<div class="grid grid-cols-3 gap-4 items-start">
    @foreach ($folders as $folder)
        <div class="bg-white p-6 rounded-xl border-t-4 border-blue-400 space-y-4">
            <div class=" relative flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 text-blue-500 p-3 rounded-lg">
                        <x-lucide-folder class="size-6"/>
                    </div>
                    <h1 class="text-lg font-bold text-gray-800">{{ $folder->name }}</h1>
                </div>
                <button class="cursor-pointer text-gray-500">
                    <x-lucide-ellipsis-vertical class="size-5"/>
                </button>


            </div>
            <p class="text-gray-500">{{ $folder->description }}</p>
            <div class="flex items-center justify-between text-gray-500">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span>45 questions</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>{{ $folder->updated_at->format('F j, Y') }}</span>
                    </div>
                </div>
                <span class="bg-gray-200 px-3 rounded-md ">Private</span>
            </div>
            <div class="grid grid-cols-[1fr_1fr_45px] gap-3">
                <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-xl">Start Quiz</button>
                <a  class="text-center bg-gray-100 hover:bg-gray-200 cursor-pointer border border-gray-300 p-2 rounded-xl">Open</a>
                <button class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 rounded-xl flex items-center justify-center text-gray-600 cursor-pointer">
                    <x-lucide-share-2 class="size-4"/>
                </button>
            </div>
        </div>
    @endforeach

</div>
