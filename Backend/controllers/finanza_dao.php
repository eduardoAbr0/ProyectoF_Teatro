<?php

include_once('../database/conexion_bd_teatro.php');
include_once('../models/model_finanza.php');

class FinanzaDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionBD();
    }

    //-----METODOS ABCC---

    //ALTAS
    public function agregarFinanza($finanza)
    {
        //INSTRUCCION SQL A EXECUTAR
        $sql = "INSERT INTO finanzas (fecha, tipo, concepto, monto, id_obra)VALUES (?, ?, ?, ?, ?)";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $fecha = $finanza->getFecha();
        $tipo = $finanza->getTipo();
        $concepto = $finanza->getConcepto();
        $monto = $finanza->getMonto();
        $id_obra = $finanza->getIdObra();

        if ($id_obra == "") {
            $id_obra = null;
        }

        $stmt->bind_param("sssdi", $fecha, $tipo, $concepto, $monto, $id_obra);

        $res = $stmt->execute();

        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //CAMBIOS
    public function cambioFinanza($finanza)
    {
        $sql = "UPDATE finanzas SET fecha=?, tipo=?, concepto=?, monto=?, id_obra=? WHERE id_finanza=?";

        $stmt = $this->conexion->getConexion()->prepare($sql);

        $fecha = $finanza->getFecha();
        $tipo = $finanza->getTipo();
        $concepto = $finanza->getConcepto();
        $monto = $finanza->getMonto();
        $id_obra = $finanza->getIdObra();
        $id = $finanza->getIdFinanza();

        if ($id_obra == "") {
            $id_obra = null;
        }

        $stmt->bind_param("sssdii", $fecha, $tipo, $concepto, $monto, $id_obra, $id);

        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //BAJAS
    public function eliminarFinanza($id)
    {
        $sql = "DELETE FROM finanzas WHERE id_finanza = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();
        return $res;
    }

    //CONSULTAS
    public function mostrarFinanzas()
    {
        $sql = "SELECT * FROM finanzas";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //CONSULTA ID
    public function mostrarFinanzaDetalle($id)
    {
        $sql = "SELECT * FROM finanzas WHERE id_finanza = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }
}
