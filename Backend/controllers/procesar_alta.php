<?php
header('Content-Type: application/json');

include_once('./miembro_dao.php');
include_once('../models/model_miembro.php');

$nombre = isset($_POST['formNombre']) ? trim($_POST['formNombre']) : "";
$apellido = isset($_POST['formPrimerAp']) ? trim($_POST['formPrimerAp']) : "";
$sApellido = isset($_POST['formSegundoAp']) ? trim($_POST['formSegundoAp']) : "";
$telefono = isset($_POST['formTelefono']) ? trim($_POST['formTelefono']) : "";
$email = isset($_POST['formEmail']) ? trim($_POST['formEmail']) : "";
$numcasa = isset($_POST['formNumCasa']) ? trim($_POST['formNumCasa']) : "";
$calle = isset($_POST['formCalle']) ? trim($_POST['formCalle']) : "";
$col = isset($_POST['formColonia']) ? trim($_POST['formColonia']) : "";
$cp = isset($_POST['formCP']) ? trim($_POST['formCP']) : "";
$estadoMembresia = isset($_POST['formEstadoMembresia']) ? $_POST['formEstadoMembresia'] : "Sin pagar";
$fechaPagoCuota = isset($_POST['formFechaPago']) && !empty($_POST['formFechaPago']) ? $_POST['formFechaPago'] : null;

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

try {
    $miembroDAO = new MiembroDAO();

    $res = $miembroDAO->agregarMiembro($miembro);

    if ($res) {
        echo json_encode(['status' => 'exito', 'message' => 'Miembro agregado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>