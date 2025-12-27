<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelPacienteController;

Route::get('/', [PanelPacienteController::class, 'home'])->name('panel.home');
Route::get('/servicios', [PanelPacienteController::class, 'servicios'])->name('panel.servicios');
Route::get('/preguntas-frecuentes', [PanelPacienteController::class, 'faq'])->name('panel.faq');
Route::get('/contacto', [PanelPacienteController::class, 'contacto'])->name('panel.contacto');
