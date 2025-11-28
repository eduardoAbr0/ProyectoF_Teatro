<?php

include_once('../database/conexion_bd_teatro.php');
include_once('../models/model_miembro.php');

class MiembroDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionBD();
    }

    //-----METODOS ABCC---

    //ALTAS
    public function agregarMiembro($miembro)
    {
        //INSTRUCCION SQL A EXECUTAR
        $sql = "INSERT INTO Miembros (nombre, primer_apellido, segundo_apellido, telefono, email, numero_casa, calle, colonia, cp, estado_membresia, fecha_pago_cuota)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $nombre = $miembro->getNombre();
        $pAp = $miembro->getPrimerApellido();
        $sAp = $miembro->getSegundoApellido();
        $tel = $miembro->getTelefono();
        $email = $miembro->getEmail();
        $numC = $miembro->getNumeroCasa();
        $call = $miembro->getCalle();
        $col = $miembro->getColonia();
        $cp = $miembro->getCp();
        $estado = $miembro->getEstadoMembresia();
        $fechaPago = $miembro->getFechaPagoCuota();
        if ($fechaPago === '')
            $fechaPago = null;

        $stmt->bind_param("sssssississ", $nombre, $pAp, $sAp, $tel, $email, $numC, $call, $col, $cp, $estado, $fechaPago);

        $res = $stmt->execute();

        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //CAMBIOS
    public function cambioMiembro($miembro)
    {
        //INSTRUCCION SQL A EXECUTAR
        $sql = "UPDATE Miembros SET nombre = ?, primer_apellido = ?, segundo_apellido = ?, telefono = ?, email = ?, numero_casa = ?, calle = ?, colonia = ?, cp = ?, estado_membresia = ?, fecha_pago_cuota = ?
            WHERE id_miembro = ?";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $nombre = $miembro->getNombre();
        $pAp = $miembro->getPrimerApellido();
        $sAp = $miembro->getSegundoApellido();
        $tel = $miembro->getTelefono();
        $email = $miembro->getEmail();
        $numC = $miembro->getNumeroCasa();
        $call = $miembro->getCalle();
        $col = $miembro->getColonia();
        $cp = $miembro->getCp();
        $estado = $miembro->getEstadoMembresia();
        $fechaPago = $miembro->getFechaPagoCuota();
        $id = $miembro->getIdMiembro();
        if ($fechaPago === '')
            $fechaPago = null;

        $stmt->bind_param("sssssississi", $nombre, $pAp, $sAp, $tel, $email, $numC, $call, $col, $cp, $estado, $fechaPago, $id);

        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //BAJAS
    public function eliminarMiembro($id)
    {
        $sql = "DELETE FROM Miembros WHERE id_miembro = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();
        
        return $res;
    }

    // CONSULTAS
    public function mostrarMiembros()
    {
        $sql = "SELECT id_miembro, nombre, primer_apellido, segundo_apellido FROM Miembros";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    // CONSULTA ID
    public function mostrarMiembroDetalle($id)
    {
        $sql = "SELECT * FROM Miembros WHERE id_miembro = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }
}
