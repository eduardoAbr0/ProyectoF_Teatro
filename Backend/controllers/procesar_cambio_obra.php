<?php
header('Content-Type: application/json');

include_once('./obra_dao.php');
include_once('../models/model_obra.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['modificarId'];
$titulo = isset($datos['modificarTitulo']) ? trim($datos['modificarTitulo']) : "";
$autor = isset($datos['modificarAutor']) ? trim($datos['modificarAutor']) : "";
$tipo = isset($datos['modificarTipo']) ? trim($datos['modificarTipo']) : "";
$numActos = isset($datos['modificarNumActos']) ? trim($datos['modificarNumActos']) : "";
$anioPresentacion = isset($datos['modificarAnio']) ? trim($datos['modificarAnio']) : "";
$temporada = isset($datos['modificarTemporada']) ? trim($datos['modificarTemporada']) : "";
$productor = isset($datos['modificarProductor']) ? trim($datos['modificarProductor']) : "";
$descripcion = isset($datos['modificarDescripcion']) ? trim($datos['modificarDescripcion']) : "";


$errores = [];

//VALIDACIONES
if (empty($titulo) || empty($autor) || empty($anioPresentacion) || empty($descripcion)) {
    $errores[] = "Faltan rellenar campos.";
}
if ((!is_numeric($numActos) || strlen($numActos) < 1)) {
    $errores[] = "Número de actos invalido.";
}
if ((!is_numeric($anioPresentacion) || strlen($anioPresentacion) != 4)) {
    $errores[] = "Año de presentación invalido.";
}

if (!empty($errores)) {
    $mensaje = "";

    foreach ($errores as $error) {
        $mensaje .= $error . "<br>";
    }

    echo json_encode([
        'status' => 'error',
        'message' => $mensaje
    ]);
    exit;
}

$obra = new obra(
    $titulo,
    $autor,
    $tipo,
    $numActos,
    $anioPresentacion,
    $temporada,
    $productor,
    $descripcion
);

$obra->setIdObra($id);

try {
    $obraDAO = new ObraDAO();

    $res = $obraDAO->cambioObra($obra);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Obra modificado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
