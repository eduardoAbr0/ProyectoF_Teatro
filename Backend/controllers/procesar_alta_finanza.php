<?php
header('Content-Type: application/json');

include_once('./finanza_dao.php');
include_once('../models/model_finanza.php');

$fecha = isset($_POST['formFecha']) ? trim($_POST['formFecha']) : "";
$tipo = isset($_POST['formTipo']) ? trim($_POST['formTipo']) : "";
$monto = isset($_POST['formMonto']) ? trim($_POST['formMonto']) : "";
$concepto = isset($_POST['formConcepto']) ? trim($_POST['formConcepto']) : "";
$id_obra = isset($_POST['formObra']) ? trim($_POST['formObra']) : "";

//VALIDACIONES
$errores = [];
if (empty($fecha) || empty($monto) || empty($concepto)) {
    $errores[] = "Faltan rellenar campos obligatorios.";
}
if (!is_numeric($monto) || $monto <= 0) {
    $errores[] = "Monto inválido.";
}
if ($id_obra === "seleccion") {
    $id_obra = null;
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

$finanza = new Finanza(
    $fecha,
    $tipo,
    $concepto,
    $monto,
    $id_obra
);

try {
    $finanzaDAO = new FinanzaDAO();

    $res = $finanzaDAO->agregarFinanza($finanza);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Registro financiero agregado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
