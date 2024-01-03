<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Administrators\app\Http\Controllers\AdministratorsController;
use Modules\Administrators\app\Http\Controllers\BackupDataBaseController;
use Modules\Administrators\app\Http\Controllers\ConfigurationController;
use Modules\Administrators\app\Http\Controllers\CoordinatorController;
use Modules\Administrators\app\Http\Controllers\ManagementController;
use Modules\Administrators\app\Http\Controllers\RoleController;
use Modules\Administrators\app\Http\Controllers\SecretariatController;
use Modules\Administrators\app\Http\Controllers\SupervisorController;
use Modules\Administrators\app\Http\Controllers\TeacherController;

Route::middleware(['auth', 'administrators'])->prefix('/administradores')->group(function () {
    Route::get('/', [AdministratorsController::class, 'index'])->name('administrators');
});
Route::middleware(['auth','administrations'])->prefix('/administradores/configurations')->group(function () {
    Route::get('/{id}', [ConfigurationController::class, 'index'])->name('administrators.configurations.index');
    Route::put('/{id}/update', [ConfigurationController::class, 'update'])->name('administrators.configurations.update');
});
Route::middleware(['auth'])->prefix('/administradores/backups')->group(function () {
    Route::get('/', [BackupDataBaseController::class, 'index'])->name('administrators.backups.index');
    Route::get('/create', [BackupDataBaseController::class, 'create'])->name('administrators.backups.create');
    Route::get('/clean/{filename}', [BackupDataBaseController::class, 'cleanBackup'])->name('administrators.backups.clean');
    Route::get('/download/{filename}', [BackupDataBaseController::class, 'download'])->name('administrators.backups.download');
});
Route::middleware(['auth', 'administrators'])->prefix('administradores/supervisores')->group(function (){
    Route::get('/', [SupervisorController::class, 'index'])->name('administrators.supervisors.index');
    Route::get('/create', [SupervisorController::class, 'create'])->name('administrators.supervisors.create');
    Route::get('/{id}/edit', [SupervisorController::class, 'edit'])->name('administrators.supervisors.edit');
    Route::get('/bloqueados', [SupervisorController::class, 'allTrashed'])->name('administrators.supervisors.allTrashed');
    Route::post('/store', [SupervisorController::class, 'store'])->name('administrators.supervisors.store');
    Route::post('/bloqueados/restore/{id}', [SupervisorController::class, 'restore'])->name('administrators.supervisors.restore');
    Route::post('/import', [SupervisorController::class, 'import'])->name('administrators.supervisors.import');
    Route::put('/update-avatar/{id}', [SupervisorController::class, 'updateAvatar'])->name('administrators.supervisors.updateAvatar');
    Route::put('/update-role/{id}', [SupervisorController::class, 'updateRole'])->name('administrators.supervisors.updateRole');
    Route::put('/update-active/{id}', [SupervisorController::class, 'updateActive'])->name('administrators.supervisors.updateActive');
    Route::put('/update/{id}', [SupervisorController::class, 'update'])->name('administrators.supervisors.update');
    Route::delete('/destroy/{id}', [SupervisorController::class, 'delete'])->name('administrators.supervisors.delete');
    Route::delete('/bloqueados/permanente/{id}', [SupervisorController::class, 'forceDelete'])->name('administrators.supervisors.forceDelete');
});
Route::middleware(['auth', 'administrators'])->prefix('administradores/gestores')->group(function (){
    Route::get('/', [ManagementController::class, 'index'])->name('administrators.managements.index');
    Route::get('/create', [ManagementController::class, 'create'])->name('administrators.managements.create');
    Route::get('/{id}/edit', [ManagementController::class, 'edit'])->name('administrators.managements.edit');
    Route::get('/bloqueados', [ManagementController::class, 'allTrashed'])->name('administrators.managements.allTrashed');
    Route::post('/store', [ManagementController::class, 'store'])->name('administrators.managements.store');
    Route::post('/bloqueados/restore/{id}', [ManagementController::class, 'restore'])->name('administrators.managements.restore');
    Route::post('/import', [ManagementController::class, 'import'])->name('administrators.managements.import');
    Route::put('/update-avatar/{id}', [ManagementController::class, 'updateAvatar'])->name('administrators.managements.updateAvatar');
    Route::put('/update-role/{id}', [ManagementController::class, 'updateRole'])->name('administrators.managements.updateRole');
    Route::put('/update-active/{id}', [ManagementController::class, 'updateActive'])->name('administrators.managements.updateActive');
    Route::put('/update/{id}', [ManagementController::class, 'update'])->name('administrators.managements.update');
    Route::delete('/destroy/{id}', [ManagementController::class, 'delete'])->name('administrators.managements.delete');
    Route::delete('/bloqueados/permanente/{id}', [ManagementController::class, 'forceDelete'])->name('administrators.managements.forceDelete');
});
Route::middleware(['auth', 'administrators'])->prefix('administradores/coordenadores')->group(function (){
    Route::get('/', [CoordinatorController::class, 'index'])->name('administrators.coordinators.index');
    Route::get('/create', [CoordinatorController::class, 'create'])->name('administrators.coordinators.create');
    Route::get('/{id}/edit', [CoordinatorController::class, 'edit'])->name('administrators.coordinators.edit');
    Route::get('/bloqueados', [CoordinatorController::class, 'allTrashed'])->name('administrators.coordinators.allTrashed');
    Route::post('/store', [CoordinatorController::class, 'store'])->name('administrators.coordinators.store');
    Route::post('/bloqueados/restore/{id}', [CoordinatorController::class, 'restore'])->name('administrators.coordinators.restore');
    Route::post('/import', [CoordinatorController::class, 'import'])->name('administrators.coordinators.import');
    Route::put('/update-avatar/{id}', [CoordinatorController::class, 'updateAvatar'])->name('administrators.coordinators.updateAvatar');
    Route::put('/update-role/{id}', [CoordinatorController::class, 'updateRole'])->name('administrators.coordinators.updateRole');
    Route::put('/update-active/{id}', [CoordinatorController::class, 'updateActive'])->name('administrators.coordinators.updateActive');
    Route::put('/update/{id}', [CoordinatorController::class, 'update'])->name('administrators.coordinators.update');
    Route::delete('/destroy/{id}', [CoordinatorController::class, 'delete'])->name('administrators.coordinators.delete');
    Route::delete('/bloqueados/permanente/{id}', [CoordinatorController::class, 'forceDelete'])->name('administrators.coordinators.forceDelete');
});
Route::middleware(['auth', 'administrators'])->prefix('administradores/secretaria')->group(function (){
    Route::get('/', [SecretariatController::class, 'index'])->name('administrators.secretariats.index');
    Route::get('/create', [SecretariatController::class, 'create'])->name('administrators.secretariats.create');
    Route::get('/{id}/edit', [SecretariatController::class, 'edit'])->name('administrators.secretariats.edit');
    Route::get('/bloqueados', [SecretariatController::class, 'allTrashed'])->name('administrators.secretariats.allTrashed');
    Route::post('/store', [SecretariatController::class, 'store'])->name('administrators.secretariats.store');
    Route::post('/bloqueados/restore/{id}', [SecretariatController::class, 'restore'])->name('administrators.secretariats.restore');
    Route::post('/import', [SecretariatController::class, 'import'])->name('administrators.secretariats.import');
    Route::put('/update-avatar/{id}', [SecretariatController::class, 'updateAvatar'])->name('administrators.secretariats.updateAvatar');
    Route::put('/update-role/{id}', [SecretariatController::class, 'updateRole'])->name('administrators.secretariats.updateRole');
    Route::put('/update-active/{id}', [SecretariatController::class, 'updateActive'])->name('administrators.secretariats.updateActive');
    Route::put('/update/{id}', [SecretariatController::class, 'update'])->name('administrators.secretariats.update');
    Route::delete('/destroy/{id}', [SecretariatController::class, 'delete'])->name('administrators.secretariats.delete');
    Route::delete('/bloqueados/permanente/{id}', [SecretariatController::class, 'forceDelete'])->name('administrators.secretariats.forceDelete');
});
Route::middleware(['auth', 'administrators'])->prefix('administradores/professores')->group(function (){
    Route::get('/', [TeacherController::class, 'index'])->name('administrators.teachers.index');
    Route::get('/create', [TeacherController::class, 'create'])->name('administrators.teachers.create');
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('administrators.teachers.edit');
    Route::get('/bloqueados', [TeacherController::class, 'allTrashed'])->name('administrators.teachers.allTrashed');
    Route::post('/store', [TeacherController::class, 'store'])->name('administrators.teachers.store');
    Route::post('/bloqueados/restore/{id}', [TeacherController::class, 'restore'])->name('administrators.teachers.restore');
    Route::post('/import', [TeacherController::class, 'import'])->name('administrators.teachers.import');
    Route::put('/update-avatar/{id}', [TeacherController::class, 'updateAvatar'])->name('administrators.teachers.updateAvatar');
    Route::put('/update-role/{id}', [TeacherController::class, 'updateRole'])->name('administrators.teachers.updateRole');
    Route::put('/update-active/{id}', [TeacherController::class, 'updateActive'])->name('administrators.teachers.updateActive');
    Route::put('/update/{id}', [TeacherController::class, 'update'])->name('administrators.teachers.update');
    Route::delete('/destroy/{id}', [TeacherController::class, 'delete'])->name('administrators.teachers.delete');
    Route::delete('/bloqueados/permanente/{id}', [TeacherController::class, 'forceDelete'])->name('administrators.teachers.forceDelete');
});
Route::middleware(['auth', 'administrators'])->prefix('administradores/grupos')->group(function (){
    Route::get('/', [RoleController::class, 'index'])->name('administrators.roles.index');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('administrators.roles.edit');
    Route::post('/store', [RoleController::class, 'store'])->name('administrators.roles.store');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('administrators.roles.update');
    Route::delete('/destroy/{id}', [RoleController::class, 'delete'])->name('administrators.roles.delete');
});