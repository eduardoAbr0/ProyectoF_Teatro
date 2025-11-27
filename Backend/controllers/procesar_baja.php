<?php
include_once('miembro_dao.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['id_miembro'];

try {
    if ($id) {
        $dao = new MiembroDAO();
        $dao->eliminarMiembro($id);
        echo json_encode(["status" => "exito", "message" => "Miembro eliminado correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "ID Vacio."]);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>