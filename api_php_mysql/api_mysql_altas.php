<?php

include_once("../Backend/database/conexion_bd_teatro.php");

$con = ConexionBD::getInstance();
$conexion = $con->getConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cadenaJSON = file_get_contents("php://input");

    if ($cadenaJSON == false) {
        echo json_encode(["status" => "error", "message" => "No se recibieron datos"]);
    } else {
        $datos_miembro = json_decode($cadenaJSON, true);

        $nombre = $datos_miembro['nombre'];
        $primer_apellido = $datos_miembro['primer_apellido'];
        $segundo_apellido = $datos_miembro['segundo_apellido'];
        $telefono = $datos_miembro['telefono'];
        $email = $datos_miembro['email'];
        $numero_casa = $datos_miembro['numero_casa'];
        $calle = $datos_miembro['calle'];
        $colonia = $datos_miembro['colonia'];
        $codigo_postal = $datos_miembro['codigo_postal'];
        $estado_membresia = $datos_miembro['estado_membresia'];
        $fecha_pago_cuota = $datos_miembro['fecha_pago_cuota'];

        $sql = "INSERT INTO Miembros (nombre, primer_apellido, segundo_apellido, telefono, email, numero_casa, calle, colonia, cp, estado_membresia, fecha_pago_cuota) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssississ", $nombre, $primer_apellido, $segundo_apellido, $telefono, $email, $numero_casa, $calle, $colonia, $codigo_postal, $estado_membresia, $fecha_pago_cuota);

        if ($stmt->execute()) {
            echo json_encode(["status" => "exito", "message" => "Miembro agregado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al agregar el miembro"]);
        }

        $stmt->close();
        $conexion->close();
    }
}
?>