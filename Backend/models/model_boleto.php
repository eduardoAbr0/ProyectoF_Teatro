<?php

class Boleto
{
    private $id_boleto;
    private $id_usuario;
    private $id_asiento;
    private $id_obra;
    private $precio;
    private $fecha_compra;
    private $estado;

    public function __construct(
        $id_usuario,
        $id_asiento,
        $id_obra,
        $precio
    ) {
        $this->id_usuario = $id_usuario;
        $this->id_asiento = $id_asiento;
        $this->id_obra = $id_obra;
        $this->precio = $precio;
    }

    public function getIdBoleto()
    {
        return $this->id_boleto;
    }

    public function setIdBoleto($id_boleto)
    {
        $this->id_boleto = $id_boleto;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getIdAsiento()
    {
        return $this->id_asiento;
    }

    public function setIdAsiento($id_asiento)
    {
        $this->id_asiento = $id_asiento;
    }

    public function getIdObra()
    {
        return $this->id_obra;
    }

    public function setIdObra($id_obra)
    {
        $this->id_obra = $id_obra;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    public function setFechaCompra($fecha_compra)
    {
        $this->fecha_compra = $fecha_compra;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}

?>
