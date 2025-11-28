<?php
header('Content-Type: application/json');

include_once('./obra_dao.php');

// Verifica que se haya proporcionado un ID de miembro
if (!isset($_GET['id_obra']) || empty($_GET['id_obra'])) {
    echo json_encode(["error" => "No hay ID a buscar."]);
    exit;
}

$id = $_GET['id_obra'];
$obraDAO = new ObraDAO();

try {
    $result = $obraDAO->mostrarObraDetalle($id);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error en la base de datos."]);
        exit;
    }

    // Se obtiene el miembro
    $obra = mysqli_fetch_assoc($result);

    // Se verifica si se encontró el miembro y en caso se regresa la información
    if ($obra) {
        echo json_encode($obra);
    } else {
        echo json_encode(["error" => "Obra no encontrada."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()
    ]);
}


?>