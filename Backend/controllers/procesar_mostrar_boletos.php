<?php
header('Content-Type: application/json');

include_once('boleto_dao.php');

try {
    $boletoDAO = new BoletoDAO();
    $result = $boletoDAO->mostrarBoletos();

    //Se verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error al consultar los boletos."]);
        exit;
    }

    //Se obtienen los boletos
    $datos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $datos[] = $row;
    }

    //Se regresa la información en formato JSON
    echo json_encode($datos);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
