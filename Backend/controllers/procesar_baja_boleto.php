<?php
header('Content-Type: application/json');

include_once('boleto_dao.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['id_boleto'];

try {
    if ($id) {
        $dao = new BoletoDAO();
        $dao->eliminarBoleto($id);
        echo json_encode(["status" => "exito", "message" => "Boleto eliminado correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "ID Vacio."]);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
