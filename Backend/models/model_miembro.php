<?php

class miembro
{   
    private $id;
    private $nombre;
    private $p_apellido;
    private $s_apellido;
    private $telefono;
    private $email;
    private $numCasa;
    private $calle;
    private $colonia;
    private $cp;
    private $fechaIng;
    private $cuota;

    public function __construct($nombre,  $p_apellido,  $s_apellido,  $telefono,  $email,  $numCasa,  $calle,  $colonia,  $cp)
    {
        $this->nombre = $nombre;
        $this->p_apellido = $p_apellido;
        $this->s_apellido = $s_apellido;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->numCasa = $numCasa;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->cp = $cp;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPApellido()
    {
        return $this->p_apellido;
    }

    public function getSApellido()
    {
        return $this->s_apellido;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNumCasa()
    {
        return $this->numCasa;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function getColonia()
    {
        return $this->colonia;
    }

    public function getCp()
    {
        return $this->cp;
    }

}
