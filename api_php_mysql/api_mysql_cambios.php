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

        $id = $datos_miembro['id_miembro'];
        $nombre = $datos_miembro['nombre'];
        $primer_apellido = $datos_miembro['primer_apellido'];
        $segundo_apellido = $datos_miembro['segundo_apellido'];
        $telefono = $datos_miembro['telefono'];
        $email = $datos_miembro['email'];
        $numero_casa = $datos_miembro['numero_casa'];
        $calle = $datos_miembro['calle'];
        $colonia = $datos_miembro['colonia'];
        $codigo_postal = $datos_miembro['cp'];
        $estado_membresia = $datos_miembro['estado_membresia'];
        $fecha_pago_cuota = $datos_miembro['fecha_pago_cuota'];

        $sql = "UPDATE Miembros SET nombre=?, primer_apellido=?, segundo_apellido=?, telefono=?, email=?, numero_casa=?, calle=?, colonia=?, cp=?, estado_membresia=?, fecha_pago_cuota=? WHERE id_miembro=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssississi", $nombre, $primer_apellido, $segundo_apellido, $telefono, $email, $numero_casa, $calle, $colonia, $codigo_postal, $estado_membresia, $fecha_pago_cuota, $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "exito", "message" => "Miembro actualizado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al actualizar el miembro"]);
        }

        $stmt->close();
        $conexion->close();
    }
}
?>