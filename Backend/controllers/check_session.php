<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['usuario'])) {
    $response = ['status' => 'autenticado', 'usuario' => $_SESSION['usuario']];
} else {
    $response = ['status' => 'no_autenticado'];
}
echo json_encode($response);
?>