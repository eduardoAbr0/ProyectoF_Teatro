<?php
require_once 'usuario_dao.php';
require_once 'TeatroFacade.php';

ob_start();
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$username = isset($data['username']) ? trim($data['username']) : "";
$password = isset($data['password']) ? trim($data['password']) : "";
$recaptchaResponse = isset($data['recaptchaResponse']) ? $data['recaptchaResponse'] : "";

if (empty($recaptchaResponse)) {
    echo json_encode(['status' => 'error', 'message' => 'Por favor completa el reCAPTCHA']);
    exit;
}

$secret = '6LfO2iQsAAAAAOSxQUszsRAVkM0wo3si4bIpIuBu';
$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptchaResponse);
$responseData = json_decode($verifyResponse);

if (!$responseData->success) {
    echo json_encode(['status' => 'error', 'message' => 'Verificación de reCAPTCHA fallida']);
    exit;
}

if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan credenciales']);
    exit;
}

$facade = new TeatroFacade();
$usuario = $facade->verificarAcceso($username, $password);

if ($usuario) {
    $_SESSION['usuario'] = $usuario['username'];
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    echo json_encode(['status' => 'exito', 'message' => 'Login correcto', 'usuario' => $usuario, 'google_debug' => $responseData]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Usuario/Contraseña incorrectos']);
}
