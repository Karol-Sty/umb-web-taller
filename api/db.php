<?php
// db.php — conexión a Supabase con SSL obligatorio

$db_host = getenv('DB_HOST') ?: 'db.nvwzqegxnsbbgyeelhld.supabase.co';
$db_port = getenv('DB_PORT') ?: 5432;
$db_name = getenv('DB_NAME') ?: 'postgres';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: 'Taller123.456.';

$dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;sslmode=require";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Error de conexión a la base de datos",
        "detalle" => $e->getMessage()
    ]);
    exit;
}
