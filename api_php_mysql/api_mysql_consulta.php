<?php

    include_once("../Backend/database/conexion_bd_teatro.php");

    $con = new ConexionBD();
    $conexion = $con->getConexion();

    if($_SERVER["REQUEST_METHOD"] == "GET"){

            $sql = "SELECT * FROM Miembros";
            $res= $conexion->query($sql);
            
            $respuesta['Miembros'] = array();
            
            if($res){
            while($fila = mysqli_fetch_assoc($res)){
                $miembro = array();
                $miembro['id_miembro'] = $fila['id_miembro'];
                $miembro['nombre'] = $fila['nombre'];
                $miembro['primer_apellido'] = $fila['primer_apellido'];
                $miembro['segundo_apellido'] = $fila['segundo_apellido'];
                $miembro['telefono'] = $fila['telefono'];
                $miembro['email'] = $fila['email'];
                $miembro['numero_casa'] = $fila['numero_casa'];
                $miembro['calle'] = $fila['calle'];
                $miembro['colonia'] = $fila['colonia'];
                $miembro['cp'] = $fila['cp'];
                $miembro['estado_membresia'] = $fila['estado_membresia'];
                $miembro['fecha_pago_cuota'] = $fila['fecha_pago_cuota'];

                array_push($respuesta['Miembros'], $miembro);

                $respuesta['status'] = 'exito';
            }
            
        }else{
                $respuesta['status'] = 'error';
            }
        
        echo json_encode($respuesta);   

        $conexion->close();
        }

?>