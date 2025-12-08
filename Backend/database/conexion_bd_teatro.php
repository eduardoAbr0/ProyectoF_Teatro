<?php

class ConexionBD
{
    private static $instance = null;
    private $conexion;
    private $host = "127.0.0.1:3306";
    private $usuario = "root";
    private $password = "root";
    private $bd = "teatro_pleasantville";

    private function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->bd);

        if ($this->conexion->connect_error) {
            die("ERROR EN CONEXION A BD: " . $this->conexion->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ConexionBD();
        }
        return self::$instance;
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    private function __clone() {}

    public function __wakeup() {}
}
