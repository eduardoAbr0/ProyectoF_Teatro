<?php
header('Content-Type: application/json');

include_once('asiento_dao.php');

try {
    $asientoDAO = new AsientoDAO();

    if (isset($_GET['id_obra'])) {
        $idObra = $_GET['id_obra'];
        $result = $asientoDAO->mostrarAsientosDisponibles($idObra);
    } else {
        $result = $asientoDAO->mostrarAsientos();
    }

    if (!$result) {
        echo json_encode(["error" => "Error al consultar los asientos."]);
        exit;
    }

    $datos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $datos[] = $row;
    }

    echo json_encode($datos);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
