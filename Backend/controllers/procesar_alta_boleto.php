<?php
header('Content-Type: application/json');

include_once('./boleto_dao.php');
include_once('../models/model_boleto.php');

$idUsuario = isset($_POST['formIdUsuario']) ? trim($_POST['formIdUsuario']) : "";
$idAsiento = isset($_POST['formIdAsiento']) ? trim($_POST['formIdAsiento']) : "";
$idObra = isset($_POST['formIdObra']) ? trim($_POST['formIdObra']) : "";
$precio = isset($_POST['formPrecio']) ? trim($_POST['formPrecio']) : "";
$fechaCompra = isset($_POST['formFechaCompra']) ? trim($_POST['formFechaCompra']) : "";
$estado = isset($_POST['formEstado']) ? trim($_POST['formEstado']) : "";

//VALIDACIONES
$errores = [];
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

try {
    $boletoDAO = new BoletoDAO();

    $res = $boletoDAO->agregarBoleto($boleto);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Boleto agregado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
