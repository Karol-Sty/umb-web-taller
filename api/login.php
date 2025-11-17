<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'])) {
    $_SESSION['usuario'] = $_POST['usuario'];
    echo json_encode(['mensaje' => "Sesión iniciada para " . $_SESSION['usuario']]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['usuario'])) {
        echo json_encode(['usuario' => $_SESSION['usuario']]);
    } else {
        echo json_encode(['usuario' => null]);
    }
}
?>
