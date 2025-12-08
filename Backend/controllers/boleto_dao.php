<?php

include_once('../database/conexion_bd_teatro.php');
include_once('../models/model_boleto.php');

class BoletoDAO implements SplSubject
{
    private $conexion;
    private $observers;

    public function __construct()
    {
        $this->conexion = ConexionBD::getInstance();
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    //-----METODOS ABCC---

    //ALTAS
    public function agregarBoleto($boleto)
    {
        $sql = "CALL sp_vender_boleto(?, ?, ?, ?)";

        $stmt = $this->conexion->getConexion()->prepare($sql);

        $idUsuario = $boleto->getIdUsuario();
        $idAsiento = $boleto->getIdAsiento();
        $idObra = $boleto->getIdObra();
        $precio = $boleto->getPrecio();

        $stmt->bind_param("iiid", $idUsuario, $idAsiento, $idObra, $precio);

        $stmt->execute();

        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();

        $stmt->close();

        if ($fila && isset($fila['mensaje']) && $fila['mensaje'] == 'Exito') {
            $this->notify();
        }

        // $this->conexion->getConexion()->close();
        return $fila;
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
        // $this->conexion->getConexion()->close();

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
        // $this->conexion->getConexion()->close();
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
        // $this->conexion->getConexion()->close();

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
        // $this->conexion->getConexion()->close();

        return $res;
    }
}
