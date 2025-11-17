<?php
// index.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once 'modelo.php';

$metodo = $_SERVER['REQUEST_METHOD'];
// Parsear la URL si usas rutas tipo /api/tareas/1
$path = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
$path_parts = $path === '' ? [] : explode('/', $path);

// Obtener payload JSON si existe
$input = json_decode(file_get_contents('php://input'), true);

switch ($metodo) {
    case 'GET':
        // GET / -> devolver todas las tareas
        $tareas = obtenerTareas();
        echo json_encode($tareas);
        break;

    case 'POST':
        // Crear tarea: { "titulo": "Comprar leche" }
        if (!isset($input['titulo'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta campo titulo']);
            break;
        }
        $id = crearTarea($input['titulo']);
        echo json_encode(['mensaje' => 'Tarea creada', 'id' => $id]);
        break;

    case 'PUT':
        // Actualizar: podrías usar un id en la ruta o en el body
        // Suponemos body { "id": 1, "titulo": "...", "completada": true }
        if (!isset($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta id']);
            break;
        }
        $ok = actualizarTarea($input['id'], $input['titulo'] ?? null, $input['completada'] ?? null);
        echo json_encode(['ok' => $ok]);
        break;

    case 'DELETE':
        // body { "id": 1 } o ruta
        if (!isset($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta id']);
            break;
        }
        $ok = eliminarTarea($input['id']);
        echo json_encode(['ok' => $ok]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
