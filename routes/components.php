<?php

declare(strict_types=1);


use App\View\Components\ClubeComponent;
use App\View\Components\ConselhoComponent;
use App\View\Components\DisciplineComponent;
use App\View\Components\EletivaComponent;
use App\View\Components\ListStudentsComponents;
use App\View\Components\PresidentComponent;
use App\View\Components\ProfessorComponent;
use App\View\Components\RoomComponent;
use App\View\Components\SalaComponent;
use App\View\Components\SerieComponent;
use App\View\Components\StudentComponent;
use App\View\Components\Teachers\ConselhoTeacherComponent;
use App\View\Components\Teachers\FechamentoTeacherComponent;
use App\View\Components\Teachers\ListDisciplinesTeacherComponent;
use App\View\Components\TipoEnsinoComponent;
use App\View\Components\TutoriaComponent;
use App\View\Components\TutorComponent;
use App\View\Components\Users\ListUsersComponents;
use Illuminate\Support\Facades\Route;

//Route::middleware(['auth'])->prefix('/dashboard/components/tipos-de-ensinos')->group(function () {
//    Route::get('/', [TipoEnsinoComponent::class, 'render'])->name('dashboard.tipo_ensinos.index');
//    Route::post('/store', [TipoEnsinoComponent::class, 'store'])->name('dashboard.tipo_ensinos.store');
//    Route::put('/update/{id}', [TipoEnsinoComponent::class, 'update'])->name('dashboard.tipo_ensinos.update');
//    Route::delete('/destroy/{id}', [TipoEnsinoComponent::class, 'delete'])->name('dashboard.tipo_ensinos.delete');
//});
//Route::middleware(['auth'])->prefix('/dashboard/components/series')->group(function () {
//    Route::get('/', [SerieComponent::class, 'render'])->name('dashboard.series.index');
//    Route::get('/{serie}/rooms', [SerieComponent::class, 'rooms'])->name('dashboard.series.rooms');
//    Route::post('/store', [SerieComponent::class, 'store'])->name('dashboard.series.store');
//    Route::put('/update/{id}', [SerieComponent::class, 'update'])->name('dashboard.series.update');
//    Route::delete('/destroy/{id}', [SerieComponent::class, 'delete'])->name('dashboard.series.delete');
//});
//Route::middleware(['auth'])->prefix('/dashboard/components/turmas')->group(function () {
//    Route::get('/', [RoomComponent::class, 'render'])->name('dashboard.rooms.index');
//    Route::get('/{room}/alunos', [RoomComponent::class, 'students'])->name('dashboard.rooms.students');
//    Route::get('/{room}/disciplinas', [RoomComponent::class, 'disciplines'])->name('dashboard.rooms.disciplines');
//    Route::post('/store', [RoomComponent::class, 'store'])->name('dashboard.rooms.store');
//    Route::put('/update/{id}', [RoomComponent::class, 'update'])->name('dashboard.rooms.update');
//    Route::delete('/destroy/{id}', [RoomComponent::class, 'delete'])->name('dashboard.rooms.delete');
//});
//Route::middleware(['auth'])->prefix('/dashboard/components/disciplinas')->group(function () {
//    Route::get('/', [DisciplineComponent::class, 'render'])->name('dashboard.disciplines.index');
//    Route::get('/{room}/update-student-disciplines/', [DisciplineComponent::class, 'updateDisciplines'])->name('dashboard.rooms.students.updateDisciplines');
//    Route::post('/store', [DisciplineComponent::class, 'store'])->name('dashboard.disciplines.store');
//    Route::post('/import', [DisciplineComponent::class, 'import'])->name('dashboard.disciplines.import');
//    Route::post('/create-table-fechamento', [DisciplineComponent::class, 'createTableFechamento'])->name('dashboard.disciplines.createTableFechamento');
//    Route::put('/update-student=fechamento/{id}', [DisciplineComponent::class, 'updateStudentFechamento'])->name('dashboard.disciplines.updateStudentFechamento');
//    Route::put('/update/{id}', [DisciplineComponent::class, 'update'])->name('dashboard.disciplines.update');
//    Route::put('/update-teacher/{id}', [DisciplineComponent::class, 'updateTeacher'])->name('dashboard.disciplines.updateTeacher');
//    Route::delete('/destroy/{id}', [DisciplineComponent::class, 'delete'])->name('dashboard.disciplines.delete');
//});

//Route::middleware(['auth'])->prefix('/dashboard/components/disciplinas/professor/')->group(function () {
//    Route::get('/', [ListDisciplinesTeacherComponent::class, 'render'])->name('dashboard.disciplines.teachers.index');
//    Route::get('/{room}/{id}/fechamentos', [ListDisciplinesTeacherComponent::class, 'fechamentos'])->name('dashboard.disciplines.teachers.fechamentos');
//    Route::put('/update/{id}', [ListDisciplinesTeacherComponent::class, 'update'])->name('dashboard.disciplines.teachers.update');
//    Route::delete('/destroy/{id}', [ListDisciplinesTeacherComponent::class, 'delete'])->name('dashboard.disciplines.teachers.delete');
//
//});

//Route::middleware(['auth'])->prefix('/dashboard/components/fechamentos/professor')->group(function () {
//    Route::put('/update-table-aulas-dadas/{id}', [FechamentoTeacherComponent::class, 'updateAulasDiscipline'])
//        ->name('dashboard.fechamentos.updateAulasDiscipline');
//
//    Route::put('/update-fechamento-primeiro-bimestre/{id}', [FechamentoTeacherComponent::class, 'updateFechamentoStudentsPrimeiroBimestre'])
//        ->name('dashboard.fechamentos.updateFechamentoStudentsPrimeiroBimestre');
//
//    Route::put('/update-fechamento-segundo-bimestre/{id}', [FechamentoTeacherComponent::class, 'updateFechamentoStudentsSegundoBimestre'])
//        ->name('dashboard.fechamentos.updateFechamentoStudentsSegundoBimestre');
//
//    Route::put('/update-fechamento-terceiro-bimestre/{id}', [FechamentoTeacherComponent::class, 'updateFechamentoStudentsTerceiroBimestre'])
//        ->name('dashboard.fechamentos.updateFechamentoStudentsTerceiroBimestre');
//
//    Route::put('/update-fechamento-quarto-bimestre/{id}', [FechamentoTeacherComponent::class, 'updateFechamentoStudentsQuartoBimestre'])
//        ->name('dashboard.fechamentos.updateFechamentoStudentsQuartoBimestre');
//
//    Route::put('/update-fechamento-quinto-conceito/{id}', [FechamentoTeacherComponent::class, 'updateFechamentoStudentsQuintoConceito'])
//        ->name('dashboard.fechamentos.updateFechamentoStudentsQuintoConceito');
//
//    Route::put('/update-fechamento-table-student/{id}', [FechamentoTeacherComponent::class, 'updateFechamentoStudents'])
//        ->name('dashboard.fechamentos.updateFechamentoStudents');
//});

//Route::middleware(['auth'])->prefix('/dashboard/components/students')->group(function () {
//    Route::get('/', [ListStudentsComponents::class, 'render'])->name('dashboard.students.index');
//    Route::get('/{id}/edit', [ListStudentsComponents::class, 'edit'])->name('dashboard.students.edit');
//    Route::get('/{room}', [ListStudentsComponents::class, 'filterStudentRoom'])->name('dashboard.students.filterStudentRoom');
////    Route::any('/', [ListStudentsComponents::class, 'filterStudentRa'])->name('dashboard.students.filterStudentRa');
//    Route::post('/store', [StudentComponent::class, 'store'])->name('dashboard.students.store');
//    Route::post('/import', [StudentComponent::class, 'import'])->name('dashboard.students.import');
//    Route::put('/update/{id}', [StudentComponent::class, 'update'])->name('dashboard.students.update');
//    Route::put('/ramanejamento/{id}', [StudentComponent::class, 'ramanejamento'])->name('dashboard.students.ramanejamento');
//    Route::put('/update-avatar/{id}', [ListStudentsComponents::class, 'updateAvatar'])->name('dashboard.students.updateAvatar');
//    Route::delete('/destroy/{id}', [StudentComponent::class, 'delete'])->name('dashboard.students.delete');
//});

//Route::middleware(['auth'])->prefix('/dashboard/components/professor/students')->group(function () {
//    Route::get('/conselho', [ConselhoTeacherComponent::class, 'render'])->name('dashboard.students.conselho.teacher.index');
//    Route::get('/{room}/conselho/', [ConselhoTeacherComponent::class, 'room'])->name('dashboard.students.conselho.teacher.room');
//    Route::any('/{room}/conselho/filter', [ConselhoTeacherComponent::class, 'filterStudentRa'])
//        ->name('dashboard.students.conselho.teacher.filterStudentRa');
//
//});

//Route::middleware(['auth'])->prefix('/dashboard/components/escola/students')->group(function () {
//    Route::get('/conselho', [ConselhoComponent::class, 'render'])->name('dashboard.students.conselho.escola.index');
//    Route::get('/{room}/conselho/', [ConselhoComponent::class, 'room'])->name('dashboard.students.conselho.escola.room');
//    Route::put('/conselho/update', [ConselhoComponent::class, 'conselhoUpdateStudent'])->name('dashboard.students.conselho.escola.conselhoUpdateStudent');
//    Route::put('/conselho/update/{room}/status/primeiro-bimestre', [ConselhoComponent::class, 'updateStatusPrimeiroBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusPrimeiroBimestreRoom');
//    Route::put('/conselho/update/{room}/status/segundo-bimestre', [ConselhoComponent::class, 'updateStatusSegundoBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusSegundoBimestreRoom');
//    Route::put('/conselho/update/{room}/status/terceiro-bimestre', [ConselhoComponent::class, 'updateStatusTerceiroBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusTerceiroBimestreRoom');
//    Route::put('/conselho/update/{room}/status/quarto-bimestre', [ConselhoComponent::class, 'updateStatusQuartoBimestreRoom'])->name('dashboard.students.conselho.escola.updateStatusQuartoBimestreRoom');
//    Route::put('/conselho/update/{room}/status/quinto-conceito', [ConselhoComponent::class, 'updateStatusQuintoConceitoRoom'])->name('dashboard.students.conselho.escola.updateStatusQuintoConceitoRoom');
//
//
//    Route::any('/{room}/conselho/filter', [ConselhoComponent::class, 'filterStudentRa'])
//        ->name('dashboard.conselho.students.filterStudentRa');
//
//});

//Route::middleware(['auth'])->prefix('/dashboard/components/usuários')->group(function () {
//    Route::get('/', [ListUsersComponents::class, 'render'])->name('dashboard.users.index');
//    Route::get('/{id}/edit', [ListUsersComponents::class, 'edit'])->name('dashboard.users.edit');
//    Route::get('/bloqueados', [ListUsersComponents::class, 'allTrashed'])->name('dashboard.users.allTrashed');
//    Route::post('/bloqueados/restore/{id}', [ListUsersComponents::class, 'restore'])->name('dashboard.users.restore');
//    Route::put('/update-avatar/{id}', [ListUsersComponents::class, 'updateAvatar'])->name('dashboard.users.updateAvatar');
//    Route::put('/update-role/{id}', [ListUsersComponents::class, 'updateRole'])->name('dashboard.users.updateRole');
//    Route::put('/update-active/{id}', [ListUsersComponents::class, 'updateActive'])->name('dashboard.users.updateActive');
//    Route::put('/update/{id}', [ListUsersComponents::class, 'update'])->name('dashboard.users.update');
//    Route::delete('/destroy/{id}', [ListUsersComponents::class, 'delete'])->name('dashboard.users.delete');
//    Route::delete('/bloqueados/permanente/{id}', [ListUsersComponents::class, 'forceDelete'])->name('dashboard.users.forceDelete');
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/salas')->group(function () {
//    Route::get('/', [SalaComponent::class, 'render'])->name('dashboard.salas.index');
//    Route::get('/{id}/edit', [SalaComponent::class, 'edit'])->name('dashboard.salas.edit');
//    Route::get('/{id}/tutorados', [SalaComponent::class, 'tutorados'])->name('dashboard.salas.tutorados');
//    Route::get('/{id}/clubes', [SalaComponent::class, 'clubes'])->name('dashboard.salas.clubes');
//    Route::post('/store-student-tutoria', [SalaComponent::class, 'storeStudentTutoria'])->name('dashboard.salas.storeStudentTutoria');
//    Route::post('/store-student-clube', [SalaComponent::class, 'storeStudentClube'])->name('dashboard.salas.storeStudentClube');
//    Route::post('/store', [SalaComponent::class, 'store'])->name('dashboard.salas.store');
//    Route::put('/update/{id}', [SalaComponent::class, 'update'])->name('dashboard.salas.update');
//    Route::put('/update/{id}/update-sala', [SalaComponent::class, 'updateLimitTutoria'])->name('dashboard.salas.updateLimitTutoria');
//    Route::put('/update/{id}/limit-students-clube', [SalaComponent::class, 'updateLimitClube'])->name('dashboard.salas.updateLimitClube');
//    Route::put('/update/{id}/status-clube', [SalaComponent::class, 'updateStatusClube'])->name('dashboard.salas.updateStatusClube');
//    Route::put('/update/{id}/update-presidente-clube', [SalaComponent::class, 'updatePresidenteClube'])->name('dashboard.salas.updatePresidenteClube');
//    Route::delete('/destroy/{id}', [SalaComponent::class, 'delete'])->name('dashboard.salas.delete');
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/tutores')->group(function () {
//    Route::get('/', [TutorComponent::class, 'render'])->name('dashboard.tutors.index');
//    Route::get('/{id}/edit', [TutorComponent::class, 'edit'])->name('dashboard.tutors.edit');
//    Route::get('/{id}/tutorados', [TutorComponent::class, 'tutorias'])->name('dashboard.tutors.tutorias');
//    Route::get('/tutorias/{id}/alunos/gerar-pdf', [TutorComponent::class, 'studentsTutoriaPdf'])->name('dashboard.tutors.tutorias.studentsTutoriaPdf');
//    Route::post('/store', [TutorComponent::class, 'store'])->name('dashboard.tutors.store');
//    Route::post('/store-students-tutorados', [TutorComponent::class, 'storeStudentTutorias'])->name('dashboard.tutors.storeStudentTutorias');
//    Route::put('/update/{id}/tutors', [TutorComponent::class, 'update'])->name('dashboard.tutors.update');
//    Route::put('/update/{id}/status-tutor', [TutorComponent::class, 'updateStatusTutor'])->name('dashboard.salas.updateStatusTutor');
//    Route::put('/update/{id}/limit-tutor', [TutorComponent::class, 'updateLimitTutor'])->name('dashboard.salas.updateLimitTutor');
//    Route::put('/update/{id}/sala/tutor', [TutorComponent::class, 'updateSala'])->name('dashboard.tutors.updateSala');
//    Route::delete('/destroy/{id}/tutor', [TutorComponent::class, 'delete'])->name('dashboard.tutors.delete');
//
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/presidente-clube')->group(function () {
//    Route::get('/', [PresidentComponent::class, 'render'])->name('dashboard.presidents.index');
//    Route::get('/{id}/edit', [PresidentComponent::class, 'edit'])->name('dashboard.presidents.edit');
//    Route::get('/{id}/clubes', [PresidentComponent::class, 'clubes'])->name('dashboard.presidents.clubes');
//    Route::get('/clubes/{id}/alunos/gerar-pdf', [PresidentComponent::class, 'studentsClubePdf'])->name('dashboard.presidents.clubes.studentsClubePdf');
//    Route::post('/store', [PresidentComponent::class, 'store'])->name('dashboard.presidents.store');
//    Route::put('/update/{id}', [PresidentComponent::class, 'update'])->name('dashboard.presidents.update');
//    Route::post('/store-students-clubes', [PresidentComponent::class, 'storeStudentClubes'])->name('dashboard.presidents.storeStudentClubes');
//    Route::put('/update/{id}/presidents', [PresidentComponent::class, 'update'])->name('dashboard.presidents.update');
//    Route::put('/update/{id}/status-president', [PresidentComponent::class, 'updateStatusPresident'])->name('dashboard.salas.updateStatusPresident');
//    Route::put('/update/{id}/limit-president', [PresidentComponent::class, 'updateLimitPresident'])->name('dashboard.salas.updateLimitPresident');
//    Route::put('/update/{id}/sala/president', [PresidentComponent::class, 'updateSala'])->name('dashboard.presidents.updateSala');
//    Route::delete('/destroy/{id}/president', [PresidentComponent::class, 'delete'])->name('dashboard.presidents.delete');
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/eletivas')->group(function () {
//    Route::get('/', [ProfessorComponent::class, 'render'])->name('dashboard.professors.index');
//    Route::get('/{id}/edit', [ProfessorComponent::class, 'edit'])->name('dashboard.professors.edit');
//    Route::get('/{id}/eletivas', [ProfessorComponent::class, 'eletivas'])->name('dashboard.professors.eletivas');
//    Route::get('/eletivas/{id}/alunos/gerar-pdf', [ProfessorComponent::class, 'studentsEletivaPdf'])->name('dashboard.professors.eletivas.studentsEletivaPdf');
//    Route::post('/store', [ProfessorComponent::class, 'store'])->name('dashboard.professors.store');
//    Route::post('/store-students-eletivas', [ProfessorComponent::class, 'storeStudentEletivas'])->name('dashboard.professors.storeStudentEletivas');
//    Route::put('/update/{id}/professors', [ProfessorComponent::class, 'update'])->name('dashboard.professors.update');
//    Route::put('/update/{id}/status-professor', [ProfessorComponent::class, 'updateStatusProfessor'])->name('dashboard.salas.updateStatusProfessor');
//    Route::put('/update/{id}/limit-professor', [ProfessorComponent::class, 'updateLimitProfessor'])->name('dashboard.salas.updateLimitProfessor');
//    Route::put('/update/{id}/sala/professor', [ProfessorComponent::class, 'updateSala'])->name('dashboard.professors.updateSala');
//    Route::delete('/destroy/{id}/professor', [ProfessorComponent::class, 'delete'])->name('dashboard.professors.delete');
//
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/tutorados')->group(function () {
//    Route::delete('/destroy/{id}', [TutoriaComponent::class, 'delete'])->name('dashboard.tutorados.delete');
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/clubes')->group(function () {
//    Route::delete('/destroy/{id}', [ClubeComponent::class, 'delete'])->name('dashboard.clubes.delete');
//});
//
//Route::middleware(['auth'])->prefix('/dashboard/components/eletivas')->group(function () {
//    Route::delete('/destroy/{id}', [EletivaComponent::class, 'delete'])->name('dashboard.eletivas.delete');
//});
