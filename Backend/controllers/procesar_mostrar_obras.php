<?php
header('Content-Type: application/json');

include_once('obra_dao.php');

try {
    $obraDAO = new ObraDAO();
    $result = $obraDAO->mostrarObras();

    //Se verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error al consultar las obras."]);
        exit;
    }

    //Se obtienen las obras
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
