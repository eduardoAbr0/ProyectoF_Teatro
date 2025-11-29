<?php

class Finanza
{
    private $id_finanza;
    private $fecha;
    private $tipo;
    private $concepto;
    private $monto;
    private $id_obra;

    public function __construct(
        $fecha,
        $tipo,
        $concepto,
        $monto,
        $id_obra = null,
        $id_finanza = null
    ) {
        $this->fecha = $fecha;
        $this->tipo = $tipo;
        $this->concepto = $concepto;
        $this->monto = $monto;
        $this->id_obra = $id_obra;
        $this->id_finanza = $id_finanza;
    }

    public function getIdFinanza()
    {
        return $this->id_finanza;
    }

    public function setIdFinanza($id_finanza)
    {
        $this->id_finanza = $id_finanza;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getConcepto()
    {
        return $this->concepto;
    }

    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function getIdObra()
    {
        return $this->id_obra;
    }

    public function setIdObra($id_obra)
    {
        $this->id_obra = $id_obra;
    }
}

?>