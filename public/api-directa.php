<?php
// public/api-directa.php
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use App\Models\Medicion;
use App\Models\Usuario;

define('LARAVEL_START', microtime(true));

// Cargamos Laravel manualmente para tener acceso a los Modelos
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);
$response = $kernel->handle(
    $request = Request::capture()
);

// RESPUESTA DIRECTA JSON
header('Content-Type: application/json');
try {
    echo json_encode([
        'status' => 'success',
        'voltmetrics_data' => [
            'usuarios' => Usuario::all(),
            'ultima_lectura' => Medicion::latest()->first(),
            'servidor' => 'PandoraXDN_Direct_Link'
        ]
    ]);
} catch (\Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}