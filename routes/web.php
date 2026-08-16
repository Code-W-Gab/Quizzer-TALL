<?php

use App\Livewire\Pages\Folder\Index;
use App\Livewire\Pages\Folder\Show;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('quiz-folder', Index::class)->name('quiz-folder');
Route::get('quiz-folder/{id}', Show::class)->name('folder.show')->middleware('auth');
Route::get('shared', Index::class)->name('shared');
Route::get('recent-quiz', Index::class)->name('recent-quiz');
Route::get('import-shared', Index::class)->name('import-shared');
Route::get('settings', Index::class)->name('settings');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
