<?php
require_once 'db.php'; // Esto importa $pdo

// READ
function obtenerTareas() {
    global $pdo;  // ⚠️ Necesario para usar la variable global
    $sql = "SELECT id, titulo, completada FROM tareas ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// CREATE
function crearTarea($titulo) {
    global $pdo;
    $sql = "INSERT INTO tareas (titulo) VALUES (:titulo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':titulo' => $titulo]);
    return true;
}

// UPDATE
function actualizarTarea($id, $titulo = null, $completada = null) {
    global $pdo;
    $sets = [];
    $params = [':id' => $id];

    if ($titulo !== null) {
        $sets[] = "titulo = :titulo";
        $params[':titulo'] = $titulo;
    }

    if ($completada !== null) {
        $sets[] = "completada = :completada";
        $params[':completada'] = $completada ? true : false;
    }

    if (empty($sets)) return false;

    $sql = "UPDATE tareas SET " . implode(", ", $sets) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

// DELETE
function eliminarTarea($id) {
    global $pdo;
    $sql = "DELETE FROM tareas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}
?>

