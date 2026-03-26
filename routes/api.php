<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicionController;
use App\Models\Medicion;
use App\Models\Usuario; // Asegúrate de que el modelo en app/Models sea Usuario.php

/*
|--------------------------------------------------------------------------
| API Routes - Voltmetrics PandoraXDN
|--------------------------------------------------------------------------
*/

// --- RUTAS EXISTENTES (Panel Web / Admin) ---
Route::post('/login', [MedicionController::class, 'login']);
Route::get('/usuarios', [MedicionController::class, 'adminDashboard']);
Route::delete('/usuario/{id}', [MedicionController::class, 'destroy']);

// --- RUTA MAESTRA PARA LA APP MÓVIL (Todo en uno) ---
// Esta es la que usaremos en el fetch de React Native
Route::get('/voltmetrics-full-data', function () {
    try {
        return response()->json([
            'usuarios' => Usuario::all(), // Trae todos los de tus seeders
            'global_stats' => [
                'total_nodes' => Medicion::distinct('dispositivo_medicion_id')->count(), // Ajustado al nombre de tu tabla
                'last_reading' => Medicion::latest()->first()->valor ?? 0, // Ajustado a 'valor' si así se llama en tu migración
                'history' => Medicion::latest()->take(10)->get()->reverse()->values() // Datos para la gráfica
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Mantengo estas por si las usas por separado, pero la de arriba es la mejor
Route::get('/energia-movil', function () {
    return Medicion::latest()->take(10)->get()->reverse()->values();
});

Route::get('/datos-movil', function () {
    return response()->json(Usuario::all()); 
});