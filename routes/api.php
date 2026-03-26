<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicionController;
use App\Models\Medicion;
use App\Models\Usuario; 
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes - Voltmetrics PandoraXDN
|--------------------------------------------------------------------------
*/

// 1. RUTA MAESTRA: Datos completos para tu App de React Native
Route::get('/voltmetrics-full-data', function () {
    try {
        // Obtenemos los datos de la base de datos
        $usuarios = Usuario::all();
        $ultimaMedicion = Medicion::latest()->first();
        
        // Conteo de dispositivos distintos
        $totalNodos = Medicion::distinct('dispositivo_medicion_id')->count();
        
        // Historial de las últimas 10 mediciones
        $historial = Medicion::latest()->take(10)->get()->reverse()->values();

        return response()->json([
            'status' => 'success',
            'project' => 'Voltmetrics UTVT',
            'data' => [
                'usuarios' => $usuarios,
                'global_stats' => [
                    'total_nodes' => $totalNodos,
                    'last_reading' => $ultimaMedicion->valor ?? 0, 
                    'last_update' => $ultimaMedicion ? $ultimaMedicion->created_at->toDateTimeString() : null,
                    'history' => $historial
                ]
            ]
        ], 200);

    } catch (\Exception $e) {
        // Retorno de error detallado para debug en PandoraXDN
        return response()->json([
            'status' => 'error',
            'message' => 'Error en el servidor de PandoraXDN',
            'debug' => $e->getMessage()
        ], 500);
    }
});

// 2. RUTA DE LOGIN: Para autenticación desde la App Móvil
Route::post('/login-api', [MedicionController::class, 'login']);

// 3. RUTA SIMPLE: Solo lista de usuarios
Route::get('/datos-movil', function () {
    return response()->json(Usuario::all(), 200);
});

// 4. MANTENIMIENTO: Forzar limpieza de rutas y cache desde el navegador
Route::get('/clear-api', function() {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return response()->json([
        'status' => 'ok',
        'message' => 'API, Rutas y Configuración refrescadas correctamente'
    ]);
});