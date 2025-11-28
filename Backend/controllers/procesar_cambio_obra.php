<?php
header('Content-Type: application/json');

include_once('./obra_dao.php');
include_once('../models/model_obra.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['formId'];
$titulo = isset($datos['formTituloModificar']) ? trim($datos['formTituloModificar']) : "";
$autor = isset($datos['formAutorModificar']) ? trim($datos['formAutorModificar']) : "";
$tipo = isset($datos['formTipoModificar']) ? trim($datos['formTipoModificar']) : "";
$numActos = isset($datos['formNumActosModificar']) ? trim($datos['formNumActosModificar']) : "";
$anioPresentacion = isset($datos['formAnioPresentacionModificar']) ? trim($datos['formAnioPresentacionModificar']) : "";
$temporada = isset($datos['formTemporadaModificar']) ? trim($datos['formTemporadaModificar']) : "";
$productor = isset($datos['formProductorModificar']) ? trim($datos['formProductorModificar']) : "";
$descripcion = isset($datos['formDescripcionModificar']) ? trim($datos['formDescripcionModificar']) : "";


$errores = [];

//VALIDACIONES
if (empty($titulo) || empty($autor) || empty($tipo) || empty($numActos) || empty($anioPresentacion) || empty($temporada) || empty($descripcion)) {
    $errores[] = "Los campos son obligatorios.";
}
if (!empty($numActos) && (!is_numeric($numActos) || strlen($numActos) > 0)) {
    $errores[] = "El número de actos solo debe tener números.";
}
if (!empty($anioPresentacion) && (!is_numeric($anioPresentacion) || strlen($anioPresentacion) != 4)) {
    $errores[] = "El año de presentación debe tener 4 dígitos.";
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


?>
