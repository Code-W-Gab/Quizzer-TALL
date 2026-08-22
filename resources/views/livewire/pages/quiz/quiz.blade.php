<x-app-layout>
    <main class="flex justify-center">
        <div class="w-200 mt-6">
            <div class="bg-white rounded-xl border border-gray-200 p-4 space-y-4">
                <div class="flex items-center justify-between gap-4">
                    <h3>Question 1 of 3</h3>
                    <div class="bg-blue-50 text-blue-500 px-2 py-0.5 rounded-xl text-sm">multiple choices</div>
                </div>
                <x-progress-bar :value="75" />
            </div>
        </div>
    </main>
</x-app-layout>
