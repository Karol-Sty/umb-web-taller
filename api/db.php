<?php
$host = "aws-1-us-east-1.pooler.supabase.com";
$port = "6543";
$dbname = "postgres";
$user = "postgres.nvwzqegxnsbbgyeelhld";
$password = "Taller123.456."; // tu contraseña real

try {
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        "error" => "Error de conexión a la base de datos",
        "detalle" => $e->getMessage()
    ]);
    exit;
}
?>

