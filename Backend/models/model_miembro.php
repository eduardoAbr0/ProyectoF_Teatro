<?php

class Miembro
{   
    private $id_miembro;
    private $nombre;
    private $primer_apellido;
    private $segundo_apellido;
    private $telefono;
    private $email;
    private $numero_casa;
    private $calle;
    private $colonia;
    private $cp;
    private $fecha_ingreso;
    private $estado_membresia;
    private $fecha_pago_cuota;

    public function __construct(
        $nombre,
        $primer_apellido,
        $segundo_apellido,
        $telefono,
        $email,
        $numero_casa,
        $calle,
        $colonia,
        $cp
    ) {
        $this->nombre = $nombre;
        $this->primer_apellido = $primer_apellido;
        $this->segundo_apellido = $segundo_apellido;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->numero_casa = $numero_casa;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->cp = $cp;
    }

    public function getIdMiembro()
    {
        return $this->id_miembro;
    }

    public function setIdMiembro($id)
    {
        $this->id_miembro = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPrimerApellido()
    {
        return $this->primer_apellido;
    }

    public function setPrimerApellido($primer_apellido)
    {
        $this->primer_apellido = $primer_apellido;
    }

    public function getSegundoApellido()
    {
        return $this->segundo_apellido;
    }

    public function setSegundoApellido($segundo_apellido)
    {
        $this->segundo_apellido = $segundo_apellido;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNumeroCasa()
    {
        return $this->numero_casa;
    }

    public function setNumeroCasa($numero_casa)
    {
        $this->numero_casa = $numero_casa;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    public function getColonia()
    {
        return $this->colonia;
    }

    public function setColonia($colonia)
    {
        $this->colonia = $colonia;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    public function setFechaIngreso($fecha_ingreso)
    {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    public function getEstadoMembresia()
    {
        return $this->estado_membresia;
    }

    public function setEstadoMembresia($estado)
    {
        $this->estado_membresia = $estado;
    }

    public function getFechaPagoCuota()
    {
        return $this->fecha_pago_cuota;
    }

    public function setFechaPagoCuota($fecha_pago)
    {
        $this->fecha_pago_cuota = $fecha_pago;
    }
}

?>

