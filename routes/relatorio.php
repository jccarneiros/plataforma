<?php
declare(strict_types=1);


use App\Http\Controllers\Dashboard\Relatorios\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::get('/painel/alunos/gerar/qrcode/{number_ra}/pdf', [RelatorioController::class, 'gerarQrcodeAlunoPdf'])
    ->name('painel.alunos.gerar.qrcode.aluno.pdf');

Route::get('/dashboard/turmas/gerar/qrcode/room/{room}/students/pdf', [RelatorioController::class, 'gerarQrcodeRoomStudentsPdf'])
    ->name('dashboard.rooms.gerar.qrcode.room.students.pdf');
