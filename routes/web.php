<?php

use App\Http\Controllers\TriviaController;

Route::post('/csrf-test', function () {
    return 'ok';
});

Route::get('/', [TriviaController::class, 'showForm'])->name('trivia.form');
Route::post('/start-quiz', [TriviaController::class, 'startQuiz'])->name('trivia.start');
Route::get('/quiz', [TriviaController::class, 'showQuiz'])->name('trivia.quiz');
Route::post('/quiz/answer', [TriviaController::class, 'submitAnswer'])->name('trivia.answer');
Route::get('/results', [TriviaController::class, 'showResults'])->name('trivia.results');
Route::get('/history', [\App\Http\Controllers\TriviaController::class, 'showHistory'])->name('trivia.history');