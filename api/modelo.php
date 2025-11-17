<?php
require_once 'db.php';

// CREATE
function crearTarea($titulo) {
    global $pdo;
    $sql = "INSERT INTO tareas (titulo) VALUES (:titulo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':titulo' => $titulo]);
    return $pdo->lastInsertId('tareas_id_seq'); // opcional; en Postgres el sequence por defecto
}

// READ
function obtenerTareas() {
    global $pdo;
    $sql = "SELECT id, titulo, completada FROM tareas ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// UPDATE (marcar completada / editar título)
function actualizarTarea($id, $titulo = null, $completada = null) {
    global $pdo;
    $sets = [];
    $params = [':id' => $id];

    if (!is_null($titulo)) {
        $sets[] = "titulo = :titulo";
        $params[':titulo'] = $titulo;
    }
    if (!is_null($completada)) {
        $sets[] = "completada = :completada";
        // Asegurar booleano
        $params[':completada'] = ($completada) ? true : false;
    }
    if (empty($sets)) return false;

    $sql = "UPDATE tareas SET " . implode(', ', $sets) . " WHERE id = :id";
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
