<?php
header('Content-Type: application/json');

include_once('./finanza_dao.php');

$json = json_decode(file_get_contents("php://input"), true);
$datos = json_decode($json, true);

$id = $datos['id_finanza'];

try {
    if ($id) {
        $dao = new FinanzaDAO();
        $dao->eliminarFinanza($id);
        echo json_encode(["status" => "exito", "message" => "Finanza eliminada correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "ID Vacio."]);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>