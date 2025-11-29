<?php
header('Content-Type: application/json');

include_once('finanza_dao.php');
include_once('../models/model_finanza.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = isset($datos['modificarId']) ? $datos['modificarId'] : null;
$fecha = isset($datos['modificarFecha']) ? $datos['modificarFecha'] : "";
$tipo = isset($datos['modificarTipo']) ? $datos['modificarTipo'] : "";
$monto = isset($datos['modificarMonto']) ? $datos['modificarMonto'] : "";
$concepto = isset($datos['modificarConcepto']) ? $datos['modificarConcepto'] : "";
$id_obra = isset($datos['modificarObra']) ? $datos['modificarObra'] : "";


if (empty($fecha) || empty($monto) || empty($concepto)) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit;
}
if ($id_obra === "seleccion") {
    $id_obra = null;
}

$finanza = new Finanza(
    $fecha,
    $tipo,
    $concepto,
    $monto,
    $id_obra,
    $id
);

try {
    $finanzaDAO = new FinanzaDAO();
    $res = $finanzaDAO->cambioFinanza($finanza);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Registro modificado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al modificar el registro']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
