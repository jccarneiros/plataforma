<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginStudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PainelStudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('/dashboard')->group(function () {
    Route::get('/check', [LoginController::class, 'check'])->name('check');
    Route::get('/check-email', [LoginController::class, 'checkEmail'])->name('check.email');
    Route::post('/login-dashboard', [LoginController::class, 'authenticate'])->name('login.dashboard');
    Route::get('/check-student', [LoginStudentController::class, 'checkStudent'])->name('check.student');
    Route::get('/check-email-student', [LoginStudentController::class, 'checkRaStudent'])->name('check.ra.student');
    Route::post('/login-dashboard-student', [LoginStudentController::class, 'authenticate'])->name('login.dashboard.student');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'admins']);
Route::get('/{code}/students', [PainelStudentController::class, 'index'])->name('painel.students');
