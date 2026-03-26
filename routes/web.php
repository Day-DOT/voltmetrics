<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicionController;

// Acceso
Route::get('/', [MedicionController::class, 'loginView'])->name('login');
Route::post('/login', [MedicionController::class, 'login'])->name('login.post');
Route::post('/registro', [MedicionController::class, 'storeUsuario'])->name('registro.post');
Route::get('/logout', [MedicionController::class, 'logout'])->name('logout');

// Paneles
Route::get('/usuario', [MedicionController::class, 'usuarioView'])->name('usuario.dashboard');
Route::get('/monitoreo', [MedicionController::class, 'adminDashboard'])->name('admin.dashboard');

// CRUD y Gráficas
Route::get('/admin/usuario/{id}', [MedicionController::class, 'adminVerUsuario'])->name('admin.verUsuario');
Route::get('/usuario/editar/{id}', [MedicionController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/actualizar/{id}', [MedicionController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/eliminar/{id}', [MedicionController::class, 'destroy'])->name('usuario.destroy');