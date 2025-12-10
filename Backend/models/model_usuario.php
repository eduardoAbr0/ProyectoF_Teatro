<?php
class Usuario
{
    private $id_usuario;
    private $username;
    private $password;
    private $nombre;
    private $email;

    public function __construct($username, $password, $nombre, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->email = $email;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
