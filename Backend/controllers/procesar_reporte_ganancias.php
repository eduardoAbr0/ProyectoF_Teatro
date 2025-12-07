<?php
require_once 'reporte_dao.php';

header('Content-Type: application/json');

try {
    $reporteDAO = new ReporteDAO();
    $resultados = $reporteDAO->obtenerGananciasPorObra();

    echo json_encode($resultados);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
