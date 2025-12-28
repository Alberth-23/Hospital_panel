<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelPacienteController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;

// Rutas públicas (ejemplo)
Route::get('/', [PanelPacienteController::class, 'home'])->name('panel.home');
Route::get('/servicios', [PanelPacienteController::class, 'servicios'])->name('panel.servicios');
Route::get('/preguntas-frecuentes', [PanelPacienteController::class, 'faq'])->name('panel.faq');
Route::get('/contacto', [PanelPacienteController::class, 'contacto'])->name('panel.contacto');

// Autenticación (como lo tengas configurado)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rutas de PACIENTE (todas bajo auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/paciente/dashboard', [PatientDashboardController::class, 'index'])
        ->name('patient.dashboard');

    Route::get('/paciente/perfil', [PatientProfileController::class, 'edit'])
        ->name('patient.profile.edit');

    Route::put('/paciente/perfil', [PatientProfileController::class, 'update'])
        ->name('patient.profile.update');
});

// Rutas de ADMIN (auth + admin)
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });
