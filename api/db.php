<?php
$host = "aws-1-us-east-1.pooler.supabase.com"; // Session Pooler (IPv4)
$port = "5432";
$dbname = "postgres";
$user = "postgres.nvwzqegxnsbbgyeelhld";
$password = "Taller123.456.";

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    echo json_encode([
        "error" => "Error de conexión a la base de datos",
        "detalle" => $e->getMessage()
    ]);
    exit();
}
?>
