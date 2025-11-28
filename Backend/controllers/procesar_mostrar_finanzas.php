<?php
header('Content-Type: application/json');

include_once('finanza_dao.php');

try {
    $finanzaDAO = new FinanzaDAO();
    $result = $finanzaDAO->mostrarFinanzas();

    //Se verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error al consultar las finanzas."]);
        exit;
    }

    //Se obtienen las finanzas
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
