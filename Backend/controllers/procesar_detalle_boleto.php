<?php
header('Content-Type: application/json');

include_once('./boleto_dao.php');

// Verifica que se haya proporcionado un ID
if (!isset($_GET['id_boleto']) || empty($_GET['id_boleto'])) {
    echo json_encode(["error" => "No hay ID a buscar."]);
    exit;
}

$id = $_GET['id_boleto'];
$boletoDAO = new BoletoDAO();

try {
    $result = $boletoDAO->mostrarBoletoDetalle($id);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error en la base de datos."]);
        exit;
    }

    // Se obtiene el boleto
    $boleto = mysqli_fetch_assoc($result);

    // Se verifica si se encontró el boleto y en caso se regresa la información
    if ($boleto) {
        echo json_encode($boleto);
    } else {
        echo json_encode(["error" => "Boleto no encontrado."]);
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
