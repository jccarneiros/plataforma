<?php
declare(strict_types=1);


use App\Http\Controllers\Painel\AlunoController;
use App\Http\Controllers\Painel\GerarQrcodeAlunoController;
use App\Http\Controllers\Painel\ListarEntradasController;
use App\Http\Controllers\Painel\ListarSaidasController;
use App\Http\Controllers\Painel\RegistrarEntradaEstudantesController;
use App\Http\Controllers\Painel\RegistrarSaidaEstudantesController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

// Retorna a view que lista todos os alunos
    Route::get('/painel/alunos', [AlunoController::class, 'index'])->name('painel.alunos.index');

// Gera o qrcode do aluno
    Route::get('/painel/estudantes/cadastrar/qrcode', [GerarQrcodeAlunoController::class, 'gerarQrcodeAluno'])
        ->name('painel.estudantes.cadastrar.gerarQrcodeAluno');

    /*  ------------- REGISTRAR ENTRADAS E SAÍDAS - RETORNA VIEW ----------------------------- */
    // Retorna a view que exibe o componente para registrar a entrada do estudante
    Route::get('/painel/estudantes/cadastrar/entradas/{month}/{day}', [RegistrarEntradaEstudantesController::class, 'registrarEntradaEstudantes'])
        ->name('painel.estudantes.registrar.entradas');
    Route::get('/painel/estudantes/cadastrar/saidas/{month}/{day}', [RegistrarSaidaEstudantesController::class, 'registrarSaidaEstudantes'])
        ->name('painel.estudantes.registrar.saidas');
    /*  ------------- REGISTRAR ENTRADAS E SAÍDAS - RETORNA VIEW ----------------------------- */


    /*  ------------- CADASTRAR ENTRADAS E SAÍDAS ----------------------------- */
    // Registra a entrada do estudante no banco de dados
    Route::get('/painel/estudantes/cadastrar/qrcode/{code}', [RegistrarEntradaEstudantesController::class, 'cadastrarEntradaEstudantes'])
        ->name('painel.estudantes.cadastrar.entrada');
    // Registra a saida do estudante no banco de dados
    Route::post('/painel/estudantes/cadastrar/qrcode/{code}', [RegistrarSaidaEstudantesController::class, 'cadastrarSaidaEstudantes'])
        ->name('painel.estudantes.cadastrar.saida');
    /*  ------------- CADASTRAR ENTRADAS E SAÍDAS ----------------------------- */


    /*  ------------- FILTRAR ENTRADAS E SAÍDAS */
    // Retorna a view que exibe o componente para registrar a entrada do estudante
    Route::get('/painel/estudantes/cadastrar/entradas/{month}/{day}/filter', [RegistrarEntradaEstudantesController::class, 'registrarFilterEstudantesTipoEnsino'])
        ->name('painel.estudantes.filter.entradas.tipo.ensino');
    // Retorna a view que exibe o componente para registrar a saida do estudante
    Route::get('/painel/estudantes/cadastrar/saidas/{month}/{day}/filter', [RegistrarSaidaEstudantesController::class, 'registrarFilterEstudantesTipoEnsino'])
        ->name('painel.estudantes.filter.saidas.tipo.ensino');
    /*  ------------- FILTRAR ENTRADAS E SAÍDAS ----------------------------- */


    /*  ------------- LISTAR ENTRADAS E SAÍDAS - RETORNA VIEW ----------------------------- */
    //Listar as turmas
    Route::get('/painel/estudantes/listar-entradas', [ListarEntradasController::class, 'listarEntradas'])
        ->name('painel.estudantes.listar-entradas');    //Listar as turmas
    Route::get('/painel/estudantes/listar-saidas', [ListarSaidasController::class, 'listarSaidas'])
        ->name('painel.estudantes.listar-saidas');
    /*  ------------- LISTAR ENTRADAS E SAÍDAS ----------------------------- */


    /*  ------------- LISTAR ENTRADAS E SAÍDAS POR TURMA ----------------------------- */
    // Lista uma turma específica
    Route::get('/painel/estudantes/listar-entradas/{room}', [ListarEntradasController::class, 'listarEntradasPorTurma'])
        ->name('painel.estudantes.listar-turma-entradas');
    // Lista uma turma específica
    Route::get('/painel/estudantes/listar-saidas/{room}', [ListarSaidasController::class, 'listarSaidasPorTurma'])
        ->name('painel.estudantes.listar-turma-saidas');
    /*  ------------- LISTAR ENTRADAS E SAÍDAS POR TURMA ----------------------------- */

    /*  ------------- FILTRAR ENTRADAS E SAÍDAS POR TURMA ----------------------------- */
    // Filtra os alunos por turma
    Route::get('/painel/estudantes/listar-entradas/{segmentRoom}/{month}', [ListarEntradasController::class, 'filtrarEntradasEstudantesPorTurma'])
        ->name('painel.estudantes.filtrar.entradas');
    // Filtra os alunos por turma
    Route::get('/painel/estudantes/listar-saidas/{segmentRoom}/{month}', [ListarSaidasController::class, 'filtrarSaidasEstudantesPorTurma'])
        ->name('painel.estudantes.filtrar.saidas');
    /*  ------------- FILTRAR ENTRADAS E SAÍDAS POR TURMA ----------------------------- */

    // Salva o qrcode do aluno no Google Drive - NÃO ESTÁ SENDO UTILIZADA
    Route::post('/painel/gerar/qrcode/room/students/save-qrcode-google/alunos', [GerarQrcodeAlunoController::class, 'qrcodeAluno'])
        ->name('painel.alunos.qrcodeAluno');


});