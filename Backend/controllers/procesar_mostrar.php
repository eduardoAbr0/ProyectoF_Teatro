<?php
header('Content-Type: application/json');

include_once('miembro_dao.php');

try {
    $miembroDAO = new MiembroDAO();
    $result = $miembroDAO->mostrarMiembros();

    //Se verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error al consultar los miembros."]);
        exit;
    }

    //Se obtienen los miembros
    $datos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $datos[] = $row;
    }

    //Se regresa la información en formato JSON
    echo json_encode($datos);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()
    ]);
}
?>