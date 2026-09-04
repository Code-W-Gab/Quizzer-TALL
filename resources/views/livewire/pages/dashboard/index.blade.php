<?php

use Livewire\Volt\Component;
use App\Models\Folder;

new class extends Component {

    public function render(): mixed
    {

        return view('livewire.pages.dashboard.index', [

            'folders' => Folder::with(['questions.choices', 'questions.answers'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get()
        ]);
    }
}; ?>

<div class="flex justify-center">
    <div class="space-y-6 p-6 w-350">
        <div class="space-y-1">
            <h1 class="font-bold text-2xl">Hello, Gab</h1>
            <p class="text-gray-500">You have 3 quizzes pending and 2 folders shared with you.</p>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div class="px-6 py-4 rounded-xl bg-white border border-gray-200">
                <div class="bg-blue-50 text-blue-500 p-3 inline-flex rounded-lg mb-4">
                    <x-lucide-folder class="size-6"/>
                </div>
                <h1 class="text-3xl font-bold">{{ count($folders) }}</h1>
                <span class="text-sm text-gray-700">Total Folders</span>
            </div>

            <div class="px-6 py-4 rounded-xl bg-white border border-gray-200">
                <div class="bg-green-50 text-green-500 p-3 inline-flex rounded-lg mb-4">
                    <x-lucide-circle-question-mark class="size-6"/>
                </div>
                <h1 class="text-3xl font-bold">{{ $folders->sum(fn ($folder) => $folder->questions->count()) }}</h1>
                <span class="text-sm text-gray-700">Total Questions</span>
            </div>

            <div class="px-6 py-4 rounded-xl bg-white border border-gray-200">
                <div class="bg-amber-50 text-amber-500 p-3 inline-flex rounded-lg mb-4">
                    <x-lucide-play class="size-6"/>
                </div>
                <h1 class="text-3xl font-bold">24</h1>
                <span class="text-sm text-gray-700">Quiz Attempts</span>
            </div>

            <div class="px-6 py-4 rounded-xl bg-white border border-gray-200">
                <div class="bg-violet-50 text-violet-500 p-3 inline-flex rounded-lg mb-4">
                    <x-lucide-star class="size-6"/>
                </div>
                <h1 class="text-3xl font-bold">85%</h1>
                <span class="text-sm text-gray-700">Average Score</span>
            </div>
        </div>

        <div class="grid grid-cols-[1fr_400px] items-start gap-4">
            <div class="bg-white p-6 rounded-xl border border-gray-200">
                <div class="flex items-center justify-between gap-4">
                    <h1 class="text-lg font-bold">Review Activity</h1>
                    <a href="" class="text-blue-500 text-sm font-medium hover:underline">View All</a>
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between hover:bg-gray-100">
                        <h1 class="font-medium">Create Biology Folder</h1>
                        <span class="text-gray-500 text-sm">2 min ago</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200">
                <div class="flex items-center justify-between gap-4">
                    <h1 class="text-lg font-bold">Quick Quiz</h1>
                    <a href="" class="text-blue-500 text-sm font-medium hover:underline">See All</a>
                </div>
                <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between border border-gray-200 p-3 rounded-xl">
                        <div>
                            <h1 class="font-bold">Java Fundamentals</h1>
                            <span class="text-sm text-gray-500">45 questions</span>
                        </div>
                        <div class="font-bold text-blue-500 text-sm">85%</div>
                    </div>
                    <div class="flex items-center justify-between border border-gray-200 p-3 rounded-xl">
                        <div>
                            <h1 class="font-bold">HTML & CSS</h1>
                            <span class="text-sm text-gray-500">61 questions</span>
                        </div>
                        <div class="font-bold text-orange-500 text-sm">91%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
