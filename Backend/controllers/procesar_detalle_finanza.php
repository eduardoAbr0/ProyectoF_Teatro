<?php
header('Content-Type: application/json');

include_once('./finanza_dao.php');

$id = isset($_GET['id_finanza']) ? $_GET['id_finanza'] : null;

if (!$id) {
    echo json_encode(['error' => 'ID no proporcionado']);
    exit;
}

try {
    $finanzaDAO = new FinanzaDAO();
    $result = $finanzaDAO->mostrarFinanzaDetalle($id);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Registro no encontrado']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
