<?php
declare(strict_types=1);

use App\Http\Controllers\Dashboard\AreaConhecimentoController;
use App\Http\Controllers\Dashboard\ClubeController;
use App\Http\Controllers\Dashboard\ConselhoController;
use App\Http\Controllers\Dashboard\ConselhoTeacherController;
use App\Http\Controllers\Dashboard\DisciplinaController;
use App\Http\Controllers\Dashboard\DisciplineController;
use App\Http\Controllers\Dashboard\DisciplinesTeacherController;
use App\Http\Controllers\Dashboard\DocumentPeriodController;
use App\Http\Controllers\Dashboard\DocumentRecebidosController;
use App\Http\Controllers\Dashboard\DocumentTypeController;
use App\Http\Controllers\Dashboard\EletivaController;
use App\Http\Controllers\Dashboard\FechamentoTeacherController;
use App\Http\Controllers\Dashboard\ListStudentController;
use App\Http\Controllers\Dashboard\PresidentController;
use App\Http\Controllers\Dashboard\ProfessorController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\SalaController;
use App\Http\Controllers\Dashboard\SerieController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\TipoEnsinoController;
use App\Http\Controllers\Dashboard\TutorController;
use App\Http\Controllers\Dashboard\TutoriaController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Painel\AlunoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('/dashboard/usuários')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::get('/bloqueados', [UserController::class, 'allTrashed'])->name('dashboard.users.allTrashed');
    Route::get('/{profile}', [UserController::class, 'filterUserProfile'])->name('dashboard.users.filterUserProfile');
    Route::post('/bloqueados/restore/{id}', [UserController::class, 'restore'])->name('dashboard.users.restore');
    Route::post('/bloqueados/permanente/delete-users', [UserController::class, 'deleteUsers'])->name('dashboard.users.deleteUsers');
    Route::post('/bloqueados/permanente/users', [UserController::class, 'forceDeleteUsers'])->name('dashboard.users.forceDeleteUsers');
    Route::post('/bloqueados/permanente/restore-users', [UserController::class, 'restoreUsers'])->name('dashboard.users.restoreUsers');
    Route::put('/update-avatar/{id}', [UserController::class, 'updateAvatar'])->name('dashboard.users.updateAvatar');
    Route::put('/update-role/{id}', [UserController::class, 'updateRole'])->name('dashboard.users.updateRole');
    Route::put('/update-active/{id}', [UserController::class, 'updateActive'])->name('dashboard.users.updateActive');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/destroy/{id}', [UserController::class, 'delete'])->name('dashboard.users.delete');
    Route::delete('/bloqueados/permanente/{id}', [UserController::class, 'forceDelete'])->name('dashboard.users.forceDelete');
});
Route::middleware(['auth'])->prefix('/dashboard/tipos-de-ensino')->group(function () {
    Route::get('/', [TipoEnsinoController::class, 'index'])->name('dashboard.tipo_ensinos.index');
    Route::post('/store', [TipoEnsinoController::class, 'store'])->name('dashboard.tipo_ensinos.store');
    Route::put('/update/{id}', [TipoEnsinoController::class, 'update'])->name('dashboard.tipo_ensinos.update');
    Route::delete('/destroy/{id}', [TipoEnsinoController::class, 'delete'])->name('dashboard.tipo_ensinos.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/series')->group(function () {
    Route::get('/', [SerieController::class, 'index'])->name('dashboard.series.index');
    Route::post('/store', [SerieController::class, 'store'])->name('dashboard.series.store');
    Route::put('/update/{id}', [SerieController::class, 'update'])->name('dashboard.series.update');
    Route::delete('/destroy/{id}', [SerieController::class, 'delete'])->name('dashboard.series.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/')->group(function () {
    Route::get('/{tipoEnsinoId}/{serieId}/turmas', [RoomController::class, 'index'])->name('dashboard.rooms.index');
//    Route::get('/{tipoEnsinoId}/{serieId}/itinerario/turmas', [RoomController::class, 'itinerarioSerie'])->name('dashboard.rooms.itinerario');
//    Route::post('/{tipoEnsinoId}/{serieId}/itinerario/turmas', [RoomController::class, 'itinerarioStudentStore'])->name('dashboard.rooms.itinerario');
    Route::get('/{tipoEnsinoId}/{serieId}/{room}/alunos', [RoomController::class, 'students'])->name('dashboard.rooms.students');
    Route::post('/turmas/store', [RoomController::class, 'store'])->name('dashboard.rooms.store');
    Route::put('/turmas/update/{id}', [RoomController::class, 'update'])->name('dashboard.rooms.update');
    Route::put('/turmas/update/student-situation/{id}', [RoomController::class, 'updateStudentSituation'])->name('dashboard.rooms.studentSituation.update');
    Route::delete('/turmas/destroy/{id}', [RoomController::class, 'delete'])->name('dashboard.rooms.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/')->group(function () {
    Route::get('/{tipoEnsinoId}/{serie}/{room}/disciplinas', [DisciplineController::class, 'index'])->name('dashboard.disciplines.index');
    Route::get('/{tipoEnsinoId}/{serie}/{room}/update-student-disciplines/', [DisciplineController::class, 'updateDisciplines'])->name('dashboard.rooms.students.updateDisciplines');
    Route::post('/{tipoEnsinoId}/{serie}/{room}/create-table-fechamentos/new-student', [DisciplineController::class, 'createTableFechamentoStudentNew'])
        ->name('dashboard.rooms.students.createTableFechamentoStudentNew');
    Route::post('/disciplinas/store', [DisciplineController::class, 'store'])->name('dashboard.disciplines.store');
    Route::post('/disciplinas/import', [DisciplineController::class, 'import'])->name('dashboard.disciplines.import');
    Route::post('/disciplinas/create-table-fechamento', [DisciplineController::class, 'createTableFechamento'])->name('dashboard.disciplines.createTableFechamento');
    Route::put('/disciplinas/update-student-fechamento/{id}', [DisciplineController::class, 'updateStudentFechamento'])->name('dashboard.disciplines.updateStudentFechamento');
    Route::put('/disciplinas/update/{id}', [DisciplineController::class, 'update'])->name('dashboard.disciplines.update');
    Route::put('/disciplinas/update-teacher/{id}', [DisciplineController::class, 'updateTeacher'])->name('dashboard.disciplines.updateTeacher');
    Route::delete('/disciplinas/destroy/{id}', [DisciplineController::class, 'delete'])->name('dashboard.disciplines.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/turmas')->group(function () {
    Route::get('/lista', [ListStudentController::class, 'index'])->name('dashboard.students.index');
    Route::get('/lista/{room}', [ListStudentController::class, 'filterStudentRoom'])->name('dashboard.students.filterStudentRoom');
    Route::get('/lista/{id}/edit', [StudentController::class, 'edit'])->name('dashboard.students.edit');
    Route::get('/lista/{id}/export-students', [StudentController::class, 'export'])->name('dashboard.students.export');
    // Gera o qrcode do estudantes em PDF
//    Route::any('/', [ListStudentController::class, 'filterStudentRa'])->name('dashboard.students.filterStudentRa');
    Route::post('/lista/store', [StudentController::class, 'store'])->name('dashboard.students.store');
    Route::post('/lista/import', [StudentController::class, 'import'])->name('dashboard.students.import');
    Route::put('/lista/update/{id}', [StudentController::class, 'update'])->name('dashboard.students.update');
    Route::put('/lista/ramanejamento/{id}', [StudentController::class, 'ramanejamento'])->name('dashboard.students.ramanejamento');
    Route::put('/lista/update-avatar/{id}', [StudentController::class, 'updateAvatar'])->name('dashboard.students.updateAvatar');
    Route::delete('/lista/destroy/{id}', [StudentController::class, 'delete'])->name('dashboard.students.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/disciplinas/professor/')->group(function () {
    Route::get('/', [DisciplinesTeacherController::class, 'index'])->name('dashboard.disciplines.teachers.index');
    Route::get('/{id}/{discipline}/professor-export-students', [DisciplinesTeacherController::class, 'export'])->name('dashboard.disciplines.teachers.students.export');
    Route::get('/{room}/{id}/fechamentos', [DisciplinesTeacherController::class, 'fechamentos'])->name('dashboard.disciplines.teachers.fechamentos');
    Route::put('/update/{id}', [DisciplinesTeacherController::class, 'update'])->name('dashboard.disciplines.teachers.update');
    Route::delete('/destroy/{id}', [DisciplinesTeacherController::class, 'delete'])->name('dashboard.disciplines.teachers.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/fechamentos/professor')->group(function () {
    Route::put('/update-fechamento-students', [FechamentoTeacherController::class, 'updateFechamentoStudents'])->name(
        'dashboard.fechamentos.updateFechamentoStudents');
    Route::put('/{id}/import/primeiro-bimestre', [FechamentoTeacherController::class, 'importPrimeiroBimestre'])
        ->name('dashboard.students.dados.primeiroBimestre');
    Route::put('/{id}/import/segundo-bimestre', [FechamentoTeacherController::class, 'importSegundoBimestre'])
        ->name('dashboard.students.dados.segundoBimestre');
    Route::put('/{id}/import/terceiro-bimestre', [FechamentoTeacherController::class, 'importTerceiroBimestre'])
        ->name('dashboard.students.dados.terceiroBimestre');
    Route::put('/{id}/import/quarto-bimestre', [FechamentoTeacherController::class, 'importQuartoBimestre'])
        ->name('dashboard.students.dados.quartoBimestre');
    Route::put('/{id}/import/quinto-conceito', [FechamentoTeacherController::class, 'importQuintoConceito'])
        ->name('dashboard.students.dados.quintoConceito');
    Route::put('/update-table-aulas-dadas/{id}', [FechamentoTeacherController::class, 'updateAulasDiscipline'])
        ->name('dashboard.fechamentos.updateAulasDiscipline');
    Route::put('/update-fechamento-primeiro-bimestre/{id}', [FechamentoTeacherController::class, 'updateFechamentoStudentsPrimeiroBimestre'])
        ->name('dashboard.fechamentos.updateFechamentoStudentsPrimeiroBimestre');
    Route::put('/update-fechamento-segundo-bimestre/{id}', [FechamentoTeacherController::class, 'updateFechamentoStudentsSegundoBimestre'])
        ->name('dashboard.fechamentos.updateFechamentoStudentsSegundoBimestre');
    Route::put('/update-fechamento-terceiro-bimestre/{id}', [FechamentoTeacherController::class, 'updateFechamentoStudentsTerceiroBimestre'])
        ->name('dashboard.fechamentos.updateFechamentoStudentsTerceiroBimestre');
    Route::put('/update-fechamento-quarto-bimestre/{id}', [FechamentoTeacherController::class, 'updateFechamentoStudentsQuartoBimestre'])
        ->name('dashboard.fechamentos.updateFechamentoStudentsQuartoBimestre');
    Route::put('/update-fechamento-quinto-conceito/{id}', [FechamentoTeacherController::class, 'updateFechamentoStudentsQuintoConceito'])
        ->name('dashboard.fechamentos.updateFechamentoStudentsQuintoConceito');
    Route::put('/update-fechamento-table-student/{id}', [FechamentoTeacherController::class, 'updateFechamentoStudents'])
        ->name('dashboard.fechamentos.updateFechamentoStudents');
});
Route::middleware(['auth'])->prefix('/dashboard/professor/students')->group(function () {
    Route::get('/conselho', [ConselhoTeacherController::class, 'index'])->name('dashboard.students.conselho.teacher.index');
    Route::get('/{room}/conselho/', [ConselhoTeacherController::class, 'room'])->name('dashboard.students.conselho.teacher.room');
    Route::any('/{room}/conselho/filter', [ConselhoTeacherController::class, 'filterStudentRa'])
        ->name('dashboard.students.conselho.teacher.filterStudentRa');
});
Route::middleware(['auth'])->prefix('/dashboard/escola/students')->group(function () {
    Route::get('/conselho', [ConselhoController::class, 'index'])->name('dashboard.students.conselho.escola.index');
    Route::get('/{room}/conselho/', [ConselhoController::class, 'room'])->name('dashboard.students.conselho.escola.room');
    Route::put('/conselho/update', [ConselhoController::class, 'conselhoUpdateStudent'])->name('dashboard.students.conselho.escola.conselhoUpdateStudent');
    Route::put('/conselho/update/{room}/status/primeiro-bimestre', [ConselhoController::class, 'updateStatusPrimeiroBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusPrimeiroBimestreRoom');
    Route::put('/conselho/update/{room}/status/segundo-bimestre', [ConselhoController::class, 'updateStatusSegundoBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusSegundoBimestreRoom');
    Route::put('/conselho/update/{room}/status/terceiro-bimestre', [ConselhoController::class, 'updateStatusTerceiroBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusTerceiroBimestreRoom');
    Route::put('/conselho/update/{room}/status/quarto-bimestre', [ConselhoController::class, 'updateStatusQuartoBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusQuartoBimestreRoom');
    Route::put('/conselho/update/{room}/status/quinto-conceito', [ConselhoController::class, 'updateStatusQuintoConceitoRoom'])->name('dashboard.students.conselho.escola.updateStatusQuintoConceitoRoom');
    Route::any('/{room}/conselho/filter', [ConselhoController::class, 'filterStudentRa'])
        ->name('dashboard.conselho.students.filterStudentRa');
});
// SALAS
Route::middleware(['auth'])->prefix('/dashboard/salas')->group(function () {
    Route::get('/', [SalaController::class, 'index'])->name('dashboard.salas.index');
    Route::get('/{id}/edit', [SalaController::class, 'edit'])->name('dashboard.salas.edit');
    Route::get('/{id}/tutorados', [SalaController::class, 'tutorados'])->name('dashboard.salas.tutorados');
    Route::get('/{id}/clubes', [SalaController::class, 'clubes'])->name('dashboard.salas.clubes');
    Route::post('/store-student-tutoria', [SalaController::class, 'storeStudentTutoria'])->name('dashboard.salas.storeStudentTutoria');
    Route::post('/store-student-clube', [SalaController::class, 'storeStudentClube'])->name('dashboard.salas.storeStudentClube');
    Route::post('/store', [SalaController::class, 'store'])->name('dashboard.salas.store');
    Route::put('/update/{id}', [SalaController::class, 'update'])->name('dashboard.salas.update');
    Route::put('/update/{id}/update-sala', [SalaController::class, 'updateLimitTutoria'])->name('dashboard.salas.updateLimitTutoria');
    Route::put('/update/{id}/limit-students-clube', [SalaController::class, 'updateLimitClube'])->name('dashboard.salas.updateLimitClube');
    Route::put('/update/{id}/status-clube', [SalaController::class, 'updateStatusClube'])->name('dashboard.salas.updateStatusClube');
    Route::put('/update/{id}/update-presidente-clube', [SalaController::class, 'updatePresidenteClube'])->name('dashboard.salas.updatePresidenteClube');
    Route::delete('/destroy/{id}', [SalaController::class, 'delete'])->name('dashboard.salas.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/tutores')->group(function () {
    Route::get('/', [TutorController::class, 'index'])->name('dashboard.tutors.index');
    Route::get('/{id}/edit', [TutorController::class, 'edit'])->name('dashboard.tutors.edit');
    Route::get('/{id}/tutorados', [TutorController::class, 'tutorias'])->name('dashboard.tutors.tutorias');
    Route::get('/tutorias/{id}/alunos/gerar-pdf', [TutorController::class, 'studentsTutoriaPdf'])->name('dashboard.tutors.tutorias.studentsTutoriaPdf');
    Route::post('/store', [TutorController::class, 'store'])->name('dashboard.tutors.store');
    Route::post('/store-students-tutorados', [TutorController::class, 'storeStudentTutorias'])->name('dashboard.tutors.storeStudentTutorias');
    Route::put('/update/{id}/tutors', [TutorController::class, 'update'])->name('dashboard.tutors.update');
    Route::put('/update/{id}/status-tutor', [TutorController::class, 'updateStatusTutor'])->name('dashboard.salas.updateStatusTutor');
    Route::put('/update/{id}/limit-tutor', [TutorController::class, 'updateLimitTutor'])->name('dashboard.salas.updateLimitTutor');
    Route::put('/update/{id}/sala/tutor', [TutorController::class, 'updateSala'])->name('dashboard.tutors.updateSala');
    Route::delete('/destroy/{id}/tutor', [TutorController::class, 'delete'])->name('dashboard.tutors.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/presidente-clube')->group(function () {
    Route::get('/', [PresidentController::class, 'index'])->name('dashboard.presidents.index');
    Route::get('/{id}/edit', [PresidentController::class, 'edit'])->name('dashboard.presidents.edit');
    Route::get('/{id}/clubes', [PresidentController::class, 'clubes'])->name('dashboard.presidents.clubes');
    Route::get('/clubes/{id}/alunos/gerar-pdf', [PresidentController::class, 'studentsClubePdf'])->name('dashboard.presidents.clubes.studentsClubePdf');
    Route::post('/store', [PresidentController::class, 'store'])->name('dashboard.presidents.store');
    Route::put('/update/{id}', [PresidentController::class, 'update'])->name('dashboard.presidents.update');
    Route::post('/store-students-clubes', [PresidentController::class, 'storeStudentClubes'])->name('dashboard.presidents.storeStudentClubes');
    Route::put('/update/{id}/presidents', [PresidentController::class, 'update'])->name('dashboard.presidents.update');
    Route::put('/update/{id}/status-president', [PresidentController::class, 'updateStatusPresident'])->name('dashboard.salas.updateStatusPresident');
    Route::put('/update/{id}/limit-president', [PresidentController::class, 'updateLimitPresident'])->name('dashboard.salas.updateLimitPresident');
    Route::put('/update/{id}/sala/president', [PresidentController::class, 'updateSala'])->name('dashboard.presidents.updateSala');
    Route::delete('/destroy/{id}/president', [PresidentController::class, 'delete'])->name('dashboard.presidents.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/eletivas')->group(function () {
    Route::get('/', [ProfessorController::class, 'index'])->name('dashboard.professors.index');
    Route::get('/{id}/edit', [ProfessorController::class, 'edit'])->name('dashboard.professors.edit');
    Route::get('/{id}/eletivas', [ProfessorController::class, 'eletivas'])->name('dashboard.professors.eletivas');
    Route::get('/eletivas/{id}/alunos/gerar-pdf', [ProfessorController::class, 'studentsEletivaPdf'])->name('dashboard.professors.eletivas.studentsEletivaPdf');
    Route::post('/store', [ProfessorController::class, 'store'])->name('dashboard.professors.store');
    Route::post('/store-students-eletivas', [ProfessorController::class, 'storeStudentEletivas'])->name('dashboard.professors.storeStudentEletivas');
    Route::put('/update/{id}/professors', [ProfessorController::class, 'update'])->name('dashboard.professors.update');
    Route::put('/update/{id}/status-professor', [ProfessorController::class, 'updateStatusProfessor'])->name('dashboard.salas.updateStatusProfessor');
    Route::put('/update/{id}/limit-professor', [ProfessorController::class, 'updateLimitProfessor'])->name('dashboard.salas.updateLimitProfessor');
    Route::put('/update/{id}/sala/professor', [ProfessorController::class, 'updateSala'])->name('dashboard.professors.updateSala');
    Route::delete('/destroy/{id}/professor', [ProfessorController::class, 'delete'])->name('dashboard.professors.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/tutorados')->group(function () {
    Route::delete('/destroy/{id}', [TutoriaController::class, 'delete'])->name('dashboard.tutorados.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/clubes')->group(function () {
    Route::delete('/destroy/{id}', [ClubeController::class, 'delete'])->name('dashboard.clubes.delete');
});
Route::middleware(['auth'])->prefix('/dashboard/eletivas')->group(function () {
    Route::delete('/destroy/{id}', [EletivaController::class, 'delete'])->name('dashboard.eletivas.delete');
});
//DOCUMENTOS ÁREA DE CONHECIMENTO
Route::middleware(['auth'])->prefix('dashboard/documentos/gerenciar/area-de-conhecimentos')->group(function () {
    Route::get('/', [AreaConhecimentoController::class, 'index'])->name('dashboard.areaconhecimentos.index');
    Route::get('/{id}/edit', [AreaConhecimentoController::class, 'edit'])->name('dashboard.areaconhecimentos.edit');
    Route::get('/{id}/users', [AreaConhecimentoController::class, 'users'])->name('dashboard.areaconhecimentos.users');
    Route::post('/store', [AreaConhecimentoController::class, 'store'])->name('dashboard.areaconhecimentos.store');
    Route::post('/{id}/store/users', [AreaConhecimentoController::class, 'storeUsers'])->name('dashboard.areaconhecimentos.store.users');
    Route::put('/{id}/update', [AreaConhecimentoController::class, 'update'])->name('dashboard.areaconhecimentos.update');
    Route::delete('/{id}/delete/users', [AreaConhecimentoController::class, 'deleteUser'])->name('dashboard.areaconhecimentos.delete.user');
    Route::delete('/{id}/delete', [AreaConhecimentoController::class, 'delete'])->name('dashboard.areaconhecimentos.delete');
});
//DOCUMENTOS ÁREA DE CONHECIMENTO
Route::middleware(['auth'])->prefix('dashboard/documentos/gerenciar/area-de-conhecimentos')->group(function () {
    Route::get('/{area_conhecimento}/disciplinas', [DisciplinaController::class, 'index'])->name('dashboard.disciplinas.index');
    Route::post('/disciplinas/store', [DisciplinaController::class, 'store'])->name('dashboard.disciplinas.store');
    Route::put('/disciplinas/{id}/update', [DisciplinaController::class, 'update'])->name('dashboard.disciplinas.update');
    Route::delete('/disciplinas/{id}/delete', [DisciplinaController::class, 'delete'])->name('dashboard.disciplinas.delete');
});
//DOCUMENTOS TIPOS DE DOCUMENTOS
Route::middleware(['auth'])->prefix('dashboard/documentos/gerenciar/area-de-conhecimento')->group(function () {
    Route::get('/{area_conhecimento}/tipos-de-documentos', [DocumentTypeController::class, 'index'])->name('dashboard.document-types.index');
    Route::post('/tipos-de-documentos/store', [DocumentTypeController::class, 'store'])->name('dashboard.document-types.store');
    Route::put('/tipos-de-documentos/{id}/update', [DocumentTypeController::class, 'update'])->name('dashboard.document-types.update');
    Route::delete('/tipos-de-documentos/{id}/delete', [DocumentTypeController::class, 'delete'])->name('dashboard.document-types.delete');
});
//DOCUMENTOS PERÍODOS DE DOCUMENTOS
Route::middleware(['auth'])->prefix('dashboard/documentos/gerenciar/area-de-conhecimento')->group(function () {
    Route::get('/{area_conhecimento}/tipo-de-documento/{document_type}/periodos', [DocumentPeriodController::class, 'index']
    )->name('dashboard.document-periods.index');
    Route::get('/tipo-de-documento/periodo/{id}/edit', [DocumentPeriodController::class, 'edit']
    )->name('dashboard.document-periods.edit');
    Route::post('/tipo-de-documento/document-periods/periodos/store', [DocumentPeriodController::class, 'store']
    )->name('dashboard.document-periods.store');
    Route::put('/tipo-de-documento/document-periods/periodo/{id}/update', [DocumentPeriodController::class, 'update']
    )->name('dashboard.document-periods.update');
    Route::delete('/tipo-de-documento/document-periods/periodo/{id}/delete', [DocumentPeriodController::class, 'delete']
    )->name('dashboard.document-periods.delete');
    Route::get(
        '/{area_conhecimento}/tipo-de-documento/{document_type}/periodos/novo', [DocumentPeriodController::class, 'documentPeriodsCreate']
    )->name('dashboard.document-periods.create');
});
//DOCUMENTOS RECEBIDOS
Route::middleware(['auth'])->prefix('dashboard/documentos/gerenciar/area-de-conhecimento')->group(function () {
    Route::get('/{area_conhecimento}/tipo-de-documento/{document_type}/recebidos', [DocumentRecebidosController::class, 'index']
    )->name('dashboard.document-recebidos.index');
    Route::get('/{area_conhecimento}/tipo-de-documento/{document_type}/recebidos/filter/usuarios', [DocumentRecebidosController::class, 'filterDocumentRecebidosUsuarios'])
        ->name('dashboard.document-recebidos.filterDocumentRecebidosUsuarios');
});