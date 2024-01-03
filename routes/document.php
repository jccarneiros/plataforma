<?php

declare(strict_types=1);


use App\Http\Controllers\Dashboard\CreateDocumentPeriodController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->prefix('/dashboard/')->group(function () {
    Route::get('/documentos', [CreateDocumentPeriodController::class, 'index'])->name('dashboard.documents.index');

    Route::get('/documentos/{documentType}/tipo-de-documento', [CreateDocumentPeriodController::class, 'documentType'])
        ->name('dashboard.documents.documentType');

    Route::get('/documentos/tipo-de-documento/{documentPeriod}/periodos', [CreateDocumentPeriodController::class, 'documentPeriods'])
        ->name('dashboard.documents.documentPeriods');

    Route::get('/documentos/tipo-de-documento/periodo/{userDocumentPeriod}/show', [CreateDocumentPeriodController::class, 'documentShow'])
        ->name('dashboard.documents.documentShow');

    Route::get('/documentos/tipo-de-documento/periodo/{userDocumentPeriod}/edit', [CreateDocumentPeriodController::class, 'documentEdit'])
        ->name('dashboard.documents.documentEdit');

    Route::post('/documentos/tipo-de-documento/{documentPeriod}/periodo/store', [CreateDocumentPeriodController::class, 'documentStore'])
        ->name('dashboard.documents.documentStore');

    Route::put('/documentos/tipo-de-documento/periodo/{userDocumentPeriod}/update', [CreateDocumentPeriodController::class, 'documentUpdate'])
        ->name('dashboard.documents.documentUpdate');

    Route::delete('/documentos/tipo-de-documento/periodo/{userDocumentPeriod}/delete', [CreateDocumentPeriodController::class, 'documentDelete'])
        ->name('dashboard.documents.documentDelete');

});