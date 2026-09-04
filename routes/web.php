<?php
use App\Livewire\Pages\Quiz\StartQuizModal;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Volt::route('dashboard', 'pages.dashboard.index')
    ->middleware('auth')
    ->name('dashboard');

Volt::route('/quiz-folder', 'pages.folder.index')
    ->middleware('auth')
    ->name('quiz-folder');

Volt::route('/shared', 'pages.folder.index')
    ->middleware('auth')
    ->name('shared');

Volt::route('/recent-quiz', 'pages.folder.index')
    ->middleware('auth')
    ->name('recent-quiz');

Volt::route('quiz-folder/{id}', 'pages.folder.show')
    ->middleware('auth')
    ->name('folder.show');

Volt::route('start-quiz', 'pages.quiz.start-quiz')
    ->middleware('auth')
    ->name('start-quiz');

Volt::route('quiz', 'pages.quiz.quiz')
    ->middleware('auth')
    ->name('quiz');

Volt::route('result', 'pages.quiz.result')
    ->middleware('auth')
    ->name('result');

Volt::route('review-answer', 'pages.quiz.review-answer')
    ->middleware('auth')
    ->name('review-answer');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
