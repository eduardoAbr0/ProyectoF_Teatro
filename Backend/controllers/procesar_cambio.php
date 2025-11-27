<?php
header('Content-Type: application/json');

include_once('./miembro_dao.php');
include_once('../models/model_miembro.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$id = $datos['formId'];
$nombre = isset($datos['formNombreModificar']) ? trim($datos['formNombreModificar']) : "";
$apellido = isset($datos['formPrimerApModificar']) ? trim($datos['formPrimerApModificar']) : "";
$sApellido = isset($datos['formSegundoApModificar']) ? trim($datos['formSegundoApModificar']) : "";
$telefono = isset($datos['formTelefonoModificar']) ? trim($datos['formTelefonoModificar']) : "";
$email = isset($datos['formEmailModificar']) ? trim($datos['formEmailModificar']) : "";
$numcasa = isset($datos['formNumCasaModificar']) ? trim($datos['formNumCasaModificar']) : "";
$calle = isset($datos['formCalleModificar']) ? trim($datos['formCalleModificar']) : "";
$col = isset($datos['formColoniaModificar']) ? trim($datos['formColoniaModificar']) : "";
$cp = isset($datos['formCPModificar']) ? trim($datos['formCPModificar']) : "";
$estadoMembresia = isset($datos['formEstadoMembresiaModificar']) ? $datos['formEstadoMembresiaModificar'] : "Sin pagar";
$fechaPagoCuota = isset($datos['formFechaPagoModificar']) && !empty($datos['formFechaPagoModificar']) ? $datos['formFechaPagoModificar'] : null;

$errores = [];

//VALIDACIONES
$errores = [];
if (empty($nombre) || empty($apellido) || empty($email)) {
    $errores[] = "Nombre, apellido y correo son obligatorios.";
}
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El formato del correo no es válido.";
}
if (!empty($telefono) && (!is_numeric($telefono) || strlen($telefono) > 10)) {
    $errores[] = "El teléfono solo debe tener números y tener máximo 10 dígitos.";
}
if (!empty($cp)) {
    if (!is_numeric($cp)) {
        $errores[] = "El código postal debe ser numérico.";
    }
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

$miembro = new miembro(
    $nombre,
    $apellido,
    $sApellido,
    $telefono,
    $email,
    $numcasa,
    $calle,
    $col,
    $cp,
    $estadoMembresia,
    $fechaPagoCuota
);

$miembro->setIdMiembro($id);

try {
    $miembroDAO = new MiembroDAO();

    $res = $miembroDAO->cambioMiembro($miembro);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Miembro modificado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}


?>