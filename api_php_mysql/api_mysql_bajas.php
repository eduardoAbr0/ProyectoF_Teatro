<?php

    include_once("../Backend/database/conexion_bd_teatro.php");

    $con = new ConexionBD();
    $conexion = $con->getConexion();

    if($_SERVER["REQUEST_METHOD"] == "DELETE"){
        
        $cadenaJSON = file_get_contents("php://input");
        
        if(!$cadenaJSON){
            echo json_encode(["status" => "error", "message" => "No se recibieron datos"]); 
        }else{
            $datos_miembro = json_decode($cadenaJSON, true);

            $id = $datos_miembro['id'];
            
            $sql = "DELETE FROM Miembros WHERE id_miembro = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if($stmt->execute()){
                echo json_encode(["status" => "exito", "message" => "Miembro eliminado correctamente"]); 
            }else{
                echo json_encode(["status" => "error", "message" => "Error al eliminar el miembro"]); 
            }
            
            $stmt->close();
            $conexion->close();
            
        }
        
    }

?>