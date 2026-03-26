<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Verificar si la aplicación está en modo mantenimiento
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// 2. Registrar el autoloader de Composer (Sin el ../)
require __DIR__.'/vendor/autoload.php';

// 3. Inicializar Laravel (Sin el ../)
/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

// 4. Procesar la petición
$app->handleRequest(Request::capture());