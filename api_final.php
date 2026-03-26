<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = 'db.utvt.cloud';
$db   = 'db_voltmetrics';
$user = 'voltmetrics';
$pass = 'G0@%I3LFblvC';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ATTR_ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     
     // Obtenemos la última medición del SCT-013
     $stmt = $pdo->query("SELECT * FROM mediciones ORDER BY id DESC LIMIT 1");
     $lectura = $stmt->fetch();

     // Obtenemos los usuarios
     $stmtUsuarios = $pdo->query("SELECT id, nombre, email FROM usuarios");
     $usuarios = $stmtUsuarios->fetchAll();

     echo json_encode([
         'status' => 'success',
         'project' => 'Voltmetrics UTVT (Direct Mode)',
         'data' => [
             'ultima_lectura' => $lectura,
             'usuarios' => $usuarios
         ]
     ]);
} catch (\PDOException $e) {
     echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
