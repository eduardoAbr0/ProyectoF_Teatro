<?php
require_once 'usuario_dao.php';
require_once '../models/model_usuario.php';

header('Content-Type: application/json');

$username = isset($_POST['username']) ? trim($_POST['username']) : "";
$password = isset($_POST['password']) ? trim($_POST['password']) : "";
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : "";
$email = isset($_POST['email']) ? trim($_POST['email']) : "";



if (empty($username) || empty($password) || empty($nombre) || empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan datos '. $nombre . "s"]);
    exit;
}

$usuarioDAO = new UsuarioDAO();

$checkDAO = new UsuarioDAO();
if ($checkDAO->verificarUsuario($username)) {
    echo json_encode(['status' => 'error', 'message' => 'El usuario ya existe']);
    exit;
}


$usuario = new Usuario(null, $username, $password, $nombre, $email);
$res = $usuarioDAO->registrarUsuario($usuario);

if ($res) {
    echo json_encode(['status' => 'exito', 'message' => 'Usuario registrado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario']);
}
