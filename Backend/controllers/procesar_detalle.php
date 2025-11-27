<?php
header('Content-Type: application/json');

include_once('./miembro_dao.php');

// Verifica que se haya proporcionado un ID de miembro
if (!isset($_GET['id_miembro']) || empty($_GET['id_miembro'])) {
    echo json_encode(["error" => "No hay ID a buscar."]);
    exit;
}

$id = $_GET['id_miembro'];
$miembroDAO = new MiembroDAO();

try {
    $result = $miembroDAO->mostrarMiembroDetalle($id);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        echo json_encode(["error" => "Error en la base de datos."]);
        exit;
    }

    // Se obtiene el miembro
    $miembro = mysqli_fetch_assoc($result);

    // Se verifica si se encontró el miembro y en caso se regresa la información
    if ($miembro) {
        echo json_encode($miembro);
    } else {
        echo json_encode(["error" => "Miembro no encontrado."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()
    ]);
}


?>