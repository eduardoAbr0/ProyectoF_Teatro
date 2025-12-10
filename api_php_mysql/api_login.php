<?php

include_once("../Backend/database/conexion_bd_teatro.php");

$con = ConexionBD::getInstance();
$conexion = $con->getConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cadenaJSON = file_get_contents("php://input");

    if ($cadenaJSON == false) {
        echo json_encode(["status" => "error", "message" => "No se recibieron datos"]);
    } else {
        $datos_usuario = json_decode($cadenaJSON, true);

        $username = $datos_usuario['username'];
        $password= sha1($datos_usuario['password']);

        $sql = "SELECT id_usuario, nombre, email FROM usuarios WHERE username = ? AND passw = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            echo json_encode([
                "status" => "exito", 
                "message" => "Bienvenido " . $fila['nombre'],
                "id_usuario" => $fila['id_usuario']
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Usuario o contraseña incorrectos"]);
        }

        $stmt->close();
        $conexion->close();
    }
}
?>