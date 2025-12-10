<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
ob_start();

include_once("../Backend/database/conexion_bd_teatro.php");

$con = ConexionBD::getInstance();
$conexion = $con->getConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cadenaJSON = file_get_contents("php://input");

    if ($cadenaJSON == false) {
        echo json_encode(["status" => "error", "message" => "No se recibieron datos"]);
    } else {
        $datos_usuario = json_decode($cadenaJSON, true);

        $nombre = $datos_usuario['nombre'];
        $email = $datos_usuario['email'];
        $username = $datos_usuario['username'];
        $password = sha1($datos_usuario['password']);

        $sql_check = "SELECT id_usuario FROM usuarios WHERE username = ?";
        $stmt_check = $conexion->prepare($sql_check);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "El usuario ya existe"]);
        } else {
            
            $sql = "INSERT INTO usuarios (nombre, email, username, passw) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $email, $username, $password);

            if ($stmt->execute()) {
                echo json_encode(["status" => "exito", "message" => "Usuario registrado correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al registrar usuario"]);
            }
            $stmt->close();
        }
        
        $stmt_check->close();
        $conexion->close();
    }
}
?>