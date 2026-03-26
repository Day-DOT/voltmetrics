<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicionController;
use App\Models\Medicion;
use App\Models\Usuario; 
use Illuminate\Support\Facades\Artisan; // <-- Agregado para mantenimiento

/*
|--------------------------------------------------------------------------
| API Routes - Voltmetrics PandoraXDN
|--------------------------------------------------------------------------
*/

// RUTA MAESTRA (La que usa tu App de React Native)
Route::get('/voltmetrics-full-data', function () {
    try {
        // Obtenemos los datos de la base de datos de la UTVT
        $usuarios = Usuario::all();
        $ultimaMedicion = Medicion::latest()->first();
        
        return response()->json([
            'usuarios' => $usuarios,
            'global_stats' => [
                'total_nodes' => Medicion::distinct('dispositivo_medicion_id')->count(),
                'last_reading' => $ultimaMedicion->valor ?? 0, 
                'history' => Medicion::latest()->take(10)->get()->reverse()->values()
            ]
        ], 200);
    } catch (\Exception $e) {
        // Si algo falla en el servidor, esto te dirá qué fue
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// --- RUTAS DE RESPALDO/ADMIN ---
Route::post('/login-api', [MedicionController::class, 'login']); // Cambié el nombre para no chocar con la web
Route::get('/datos-movil', function () {
    return response()->json(Usuario::all()); 
});

// --- RUTA EXTRA: Por si necesitas limpiar la API sin entrar a la Web ---
Route::get('/clear-api', function() {
    Artisan::call('route:clear');
    return response()->json(['message' => 'API Refrescada']);
});