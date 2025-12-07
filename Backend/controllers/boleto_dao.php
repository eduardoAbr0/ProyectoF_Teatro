<?php

include_once('../database/conexion_bd_teatro.php');
include_once('../models/model_boleto.php');

class BoletoDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionBD();
    }

    //-----METODOS ABCC---

    //ALTAS
    public function agregarBoleto($boleto)
    {
        //INSTRUCCION SQL A EXECUTAR
        $sql = "INSERT INTO boletos (id_usuario, id_asiento, id_obra, precio, fecha_compra, estado)
            VALUES (?, ?, ?, ?, ?, ?)";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $idUsuario = $boleto->getIdUsuario();
        $idAsiento = $boleto->getIdAsiento();
        $idObra = $boleto->getIdObra();
        $precio = $boleto->getPrecio();
        $fechaCompra = $boleto->getFechaCompra();
        $estado = $boleto->getEstado();

        $stmt->bind_param("iiidss", $idUsuario, $idAsiento, $idObra, $precio, $fechaCompra, $estado);

        $res = $stmt->execute();

        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //CAMBIOS
    public function cambioBoleto($boleto)
    {
        $sql = "UPDATE boletos SET id_usuario=?, id_asiento=?, id_obra=?, precio=?, fecha_compra=?, estado=? WHERE id_boleto=?";

        $stmt = $this->conexion->getConexion()->prepare($sql);

        $idUsuario = $boleto->getIdUsuario();
        $idAsiento = $boleto->getIdAsiento();
        $idObra = $boleto->getIdObra();
        $precio = $boleto->getPrecio();
        $fechaCompra = $boleto->getFechaCompra();
        $estado = $boleto->getEstado();
        $id = $boleto->getIdBoleto();

        $stmt->bind_param("iiidssi", $idUsuario, $idAsiento, $idObra, $precio, $fechaCompra, $estado, $id);

        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //BAJAS
    public function eliminarBoleto($id)
    {
        $sql = "DELETE FROM boletos WHERE id_boleto = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();
        return $res;
    }

    //CONSULTAS
    public function mostrarBoletos()
    {
        $sql = "SELECT * FROM boletos";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //CONSULTA ID
    public function mostrarBoletoDetalle($id)
    {
        $sql = "SELECT * FROM vista_boletos_detalle WHERE id_boleto = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }
}
