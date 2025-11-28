<?php
header('Content-Type: application/json');

include_once('./obra_dao.php');
include_once('../models/model_obra.php');

$titulo = isset($_POST['formTitulo']) ? trim($_POST['formTitulo']) : "";
$autor = isset($_POST['formAutor']) ? trim($_POST['formAutor']) : "";
$tipo = isset($_POST['formTipo']) ? trim($_POST['formTipo']) : "";
$numActos = isset($_POST['formNumActos']) ? trim($_POST['formNumActos']) : "";
$anioPresentacion = isset($_POST['formAnioPresentacion']) ? trim($_POST['formAnioPresentacion']) : "";
$temporada = isset($_POST['formTemporada']) ? trim($_POST['formTemporada']) : "";
$productor = isset($_POST['formProductor']) ? trim($_POST['formProductor']) : "";
$descripcion = isset($_POST['formDescripcion']) ? trim($_POST['formDescripcion']) : "";

//VALIDACIONES
$errores = [];
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

$obra = new Obra(
    $titulo,
    $autor,
    $tipo,
    $numActos,
    $anioPresentacion,
    $temporada,
    $productor,
    $descripcion
);

try {
    $obraDAO = new ObraDAO();

    $res = $obraDAO->agregarObra($obra);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Obra agregada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>