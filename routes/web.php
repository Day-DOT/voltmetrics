<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\MedicionController;
use App\Models\Medicion;
use App\Models\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes - Voltmetrics PandoraXDN
|--------------------------------------------------------------------------
*/

// --- ACCESO Y AUTENTICACIÓN ---
Route::get('/', [MedicionController::class, 'loginView'])->name('login');
Route::post('/login', [MedicionController::class, 'login'])->name('login.post');
Route::post('/registro', [MedicionController::class, 'storeUsuario'])->name('registro.post');
Route::get('/logout', [MedicionController::class, 'logout'])->name('logout');

// --- PANELES ---
Route::get('/usuario', [MedicionController::class, 'usuarioView'])->name('usuario.dashboard');
Route::get('/monitoreo', [MedicionController::class, 'adminDashboard'])->name('admin.dashboard');

// --- CRUD Y GESTIÓN ---
Route::get('/admin/usuario/{id}', [MedicionController::class, 'adminVerUsuario'])->name('admin.verUsuario');
Route::get('/usuario/editar/{id}', [MedicionController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/actualizar/{id}', [MedicionController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/eliminar/{id}', [MedicionController::class, 'destroy'])->name('usuario.destroy');

// --- 🚀 RUTA DE EMERGENCIA PARA LA APP MÓVIL (REACT NATIVE) ---
// Usamos web.php porque el servidor PandoraXDN está bloqueando api.php
Route::get('/voltmetrics-datos-final', function () {
    try {
        return response()->json([
            'status' => 'success',
            'project' => 'Voltmetrics Final',
            'data' => [
                'usuarios' => Usuario::all(),
                'lectura' => Medicion::latest()->first(),
                'historial' => Medicion::latest()->take(10)->get()
            ]
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error en la base de datos de la UTVT',
            'debug' => $e->getMessage()
        ], 500);
    }
});

// --- 🛠️ BOTÓN DE PÁNICO Y DEBUG PARA EL SERVIDOR ---
Route::get('/limpiar-todo', function() {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "✅ Rutas y Cache actualizados en PandoraXDN. Prueba la ruta /voltmetrics-datos-final";
});

Route::get('/debug-git', function() {
    return [
        'Carpeta Actual' => getcwd(),
        '¿Existe API.php?' => file_exists(base_path('routes/api.php')),
        'Ultima Modificación API' => file_exists(base_path('routes/api.php')) 
            ? date("Y-m-d H:i:s", filemtime(base_path('routes/api.php'))) 
            : 'No encontrado'
    ];
});