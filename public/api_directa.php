<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Para que React Native no te bloquee

$host = 'db.utvt.cloud';
$db   = 'db_voltmetrics';
$user = 'voltmetrics';
$pass = 'G0@%I3LFblvC';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
    // Obtenemos la última medición del sensor SCT-013
    $stmt = $pdo->query("SELECT * FROM mediciones ORDER BY id DESC LIMIT 1");
    $lectura = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtenemos los usuarios de la UTVT
    $stmtU = $pdo->query("SELECT id, nombre, email FROM usuarios");
    $usuarios = $stmtU->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'project' => 'Voltmetrics Direct API',
        'data' => [
            'ultima_lectura' => $lectura,
            'usuarios' => $usuarios
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}