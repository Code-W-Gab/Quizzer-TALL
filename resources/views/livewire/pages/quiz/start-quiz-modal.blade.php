<main class="flex justify-center mt-10">
    <div class="bg-white rounded-xl w-200">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-900">Quiz Setup</h2>
            <p class="text-gray-500">Configure your quiz session before you start.</p>
        </div>

        <div class="border-b border-gray-300"></div>

        <div class="p-6 space-y-6">
            <div class="flex flex-col gap-4">
                <h1 class="font-bold">Select Folders</h1>
                @foreach ($folders as $folder)
                    <div class="flex items-center gap-3 border border-gray-300 py-3 px-6 rounded-lg">
                        <input type="checkbox" class="rounded-sm">
                        <h3 class="font-medium">{{ $folder->name }}</h3>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col gap-4">
                <h1 class="font-bold ">Questions Count</h1>
                <div class="grid grid-cols-4 gap-3">
                    <button class="border border-gray-300 bg-gray-100 py-2 rounded-lg font-semibold">10</button>
                    <button class="border border-gray-300 bg-gray-100 py-2 rounded-lg font-semibold">20</button>
                    <button class="border border-gray-300 bg-gray-100 py-2 rounded-lg font-semibold">30</button>
                    <button class="border border-gray-300 bg-gray-100 py-2 rounded-lg font-semibold">All</button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('quiz-folder') }}" class="text-center border border-gray-300 bg-gray-100 py-3 rounded-lg font-semibold">Cancel</a>
                <button class="bg-blue-500 text-white py-3 rounded-lg font-semibold">Start Quiz</button>
            </div>
        </div>
    </div>
</main>
