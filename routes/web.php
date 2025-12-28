<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelPacienteController;
use App\Http\Controllers\AuthController;

Route::get('/', [PanelPacienteController::class, 'home'])->name('panel.home');
Route::get('/servicios', [PanelPacienteController::class, 'servicios'])->name('panel.servicios');
Route::get('/preguntas-frecuentes', [PanelPacienteController::class, 'faq'])->name('panel.faq');
Route::get('/contacto', [PanelPacienteController::class, 'contacto'])->name('panel.contacto');
Route::get('/informacion-paciente', [PanelPacienteController::class, 'informacion'])->name('panel.informacion');

// autenticacion

Route::middleware('guest')->group(function(){
    //login
    Route::get('/login',[AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    //register

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
->middleware('auth')
->name('logout');
