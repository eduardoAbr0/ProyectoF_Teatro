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
        $sql = "INSERT INTO Miembros (Nombre, Primer_apellido, Segundo_apellido, Telefono, Email, NumCasa, Calle, Colonia, Codigo_postal)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $nombre = $miembro->getNombre();
        $pAp = $miembro->getPApellido();
        $sAp = $miembro->getSApellido();
        $tel = $miembro->getTelefono();
        $email = $miembro->getEmail();
        $numC = $miembro->getNumCasa();
        $call = $miembro->getCalle();
        $col = $miembro->getColonia();
        $cp = $miembro->getCp();
        $stmt->bind_param("sssssissi", $nombre, $pAp, $sAp, $tel, $email, $numC, $call, $col, $cp);


        $res = $stmt->execute();

        $stmt->close();

        return $res;
    }

    //CAMBIOS
    public function cambioMiembro($miembro)
    {
        //INSTRUCCION SQL A EXECUTAR
        $sql = "UPDATE Miembros SET Nombre = ?, Primer_apellido = ?, Segundo_apellido = ?, Telefono = ?, Email = ?, NumCasa = ?, Calle = ?, Colonia = ?, Codigo_postal = ?
            WHERE id = ?";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $nombre = $miembro->getNombre();
        $pAp = $miembro->getPApellido();
        $sAp = $miembro->getSApellido();
        $tel = $miembro->getTelefono();
        $email = $miembro->getEmail();
        $numC = $miembro->getNumCasa();
        $call = $miembro->getCalle();
        $col = $miembro->getColonia();
        $cp = $miembro->getCp();
        $id = $miembro->getId();
        $stmt->bind_param("sssssissii", $nombre, $pAp, $sAp, $tel, $email, $numC, $call, $col, $cp, $id);


        $res = $stmt->execute();

        $stmt->close();

        return $res;
    }

    //BAJAS
    public function eliminarMiembro($id)
    {
        $sql = "DELETE FROM Miembros WHERE id = '$id'";

        $res = mysqli_query($this->conexion->getConexion(), $sql);
        return $res;
    }

    //CONSULTAS
    public function mostrarMiembros()
    {
        //$sql = "SELECT * Alumnos WHERE Num_Control = '$nc'";
        $sql = "SELECT id, Nombre, Primer_apellido, Segundo_apellido FROM Miembros";

        return mysqli_query($this->conexion->getConexion(), $sql);
    }

    public function mostrarMiembroDetalle($id)
    {
        $sql = "SELECT * FROM Miembros WHERE id = '$id'";

        return mysqli_query($this->conexion->getConexion(), $sql);
    }
}
