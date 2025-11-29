<?php
header('Content-Type: application/json');

include_once('./boleto_dao.php');
include_once('../models/model_boleto.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['modificarId'];
$idUsuario = isset($datos['modificarIdUsuario']) ? trim($datos['modificarIdUsuario']) : "";
$idAsiento = isset($datos['modificarIdAsiento']) ? trim($datos['modificarIdAsiento']) : "";
$idObra = isset($datos['modificarIdObra']) ? trim($datos['modificarIdObra']) : "";
$precio = isset($datos['modificarPrecio']) ? trim($datos['modificarPrecio']) : "";
$fechaCompra = isset($datos['modificarFechaCompra']) ? trim($datos['modificarFechaCompra']) : "";
$estado = isset($datos['modificarEstado']) ? trim($datos['modificarEstado']) : "";


$errores = [];

//VALIDACIONES
if (empty($idUsuario) || empty($idAsiento) || empty($idObra) || empty($precio) || empty($fechaCompra) || empty($estado)) {
    $errores[] = "Faltan rellenar campos.";
}
if (!is_numeric($precio) || $precio < 0) {
    $errores[] = "Precio inválido.";
}

if (!empty($errores)) {
    $mensaje = "";

    foreach ($errores as $error) {
        $mensaje .= $error . "<br>";
    }

    echo json_encode([
        'status' => 'error',
        'message' => $mensaje
    ]);
    exit;
}

$boleto = new Boleto(
    $idUsuario,
    $idAsiento,
    $idObra,
    $precio,
    $fechaCompra,
    $estado
);

$boleto->setIdBoleto($id);

try {
    $boletoDAO = new BoletoDAO();

    $res = $boletoDAO->cambioBoleto($boleto);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Boleto modificado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
