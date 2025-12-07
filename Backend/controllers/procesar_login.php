<?php
require_once 'usuario_dao.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$username = isset($data['username']) ? trim($data['username']) : "";
$password = isset($data['password']) ? trim($data['password']) : "";

if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan credenciales']);
    exit;
}

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->login($username, $password);

if ($usuario) {
    session_start();
    $_SESSION['usuario'] = $usuario['username'];
    $_SESSION['id_usuario'] = $usuario['id_usuario'];

    echo json_encode(['status' => 'exito', 'message' => 'Login correcto', 'usuario' => $usuario]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Credenciales incorrectas']);
}
