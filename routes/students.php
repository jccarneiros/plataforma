<?php

declare(strict_types=1);

use App\Http\Controllers\PainelStudents\ClubeController;
use App\Http\Controllers\PainelStudents\EletivaController;
use App\Http\Controllers\PainelStudents\TutoriaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('/{code}/students/tutorados')->group(function () {
    Route::get('/', [TutoriaController::class, 'index'])->name('students.tutorias.index');
    Route::post('/select-tutor', [TutoriaController::class, 'selectTutor'])->name('students.tutorias.selectTutor');
});
Route::middleware(['auth'])->prefix('/{code}/students/clubes')->group(function () {
    Route::get('/', [ClubeController::class, 'index'])->name('students.clubes.index');
    Route::post('/select-president', [ClubeController::class, 'selectPresident'])->name('students.clubes.selectPresident');
});
Route::middleware(['auth'])->prefix('/{code}/students/eletivas')->group(function () {
    Route::get('/', [EletivaController::class, 'index'])->name('students.eletivas.index');
    Route::post('/select-professor', [EletivaController::class, 'selectProfessor'])->name('students.eletivas.selectProfessor');
});

