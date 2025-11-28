<?php
header('Content-Type: application/json');

include_once('obra_dao.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['id_obra'];

try {
    if ($id) {
        $dao = new ObraDAO();
        $dao->eliminarObra($id);
        echo json_encode(["status" => "exito", "message" => "Obra eliminada correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "ID Vacio."]);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
